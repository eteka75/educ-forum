<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Discussion as Discussion;

class DiscussionController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
//$this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category = '', $slug = '') {
        if (!isset($category) || !isset($slug)) {
            return redirect(config('forum.routes.home'));
        }

        $discussion = Discussion::where('slug', '=', $slug)->first();
        if (is_null($discussion)) {
            abort(404);
        }

        $discussion_category = Category::find($discussion->categorie_id);
        if ($category != $discussion_category->slug) {
            return redirect(config('forum.routes.home') . '/' . config('forum.routes.discussion') . '/' . $discussion_category->slug . '/' . $discussion->slug);
        }
        $posts = Post::with('user')->where('discussion_id', '=', $discussion->id)->orderBy('created_at', 'ASC')->paginate(10);

        $chatter_editor = config('forum.editor');

// Dynamically register markdown service provider
//\App::register('GrahamCampbell\Markdown\MarkdownServiceProvider');

        return view('forum.discussion', compact('discussion', 'posts', 'chatter_editor', 's_categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($category, $slug = null) {
        if (!isset($category) || !isset($slug)) {
            return redirect(config('chatter.routes.home'));
        }

        $discussion = Discussion::where('slug', '=', $slug)->first();
        if (is_null($discussion)) {
            abort(404);
        }
        $discussion_category = Category::find($discussion->categorie_id);

        if ($category != $discussion_category->slug) {
            return redirect(config('forum.routes.home') . '/' . config('forum.routes.discussion') . '/' . $discussion_category->slug . '/' . $discussion->slug);
        }
        $posts = Post::with('user')->where('discussion_id', '=', $discussion->id)->orderBy('created_at', 'ASC')->paginate(10);

        $chatter_editor = config('forum.editor');
// dd($chatter_editor);
// Dynamically register markdown service provider
// \App::register('GrahamCampbell\Markdown\MarkdownServiceProvider');

        return view('forum.discussion', compact('discussion', 'posts', 'chatter_editor'));
    }

    public function showCategorie($slug = '') {
        $pagination_results = config('forum.paginate.num_of_results');

        $discussions = Discussion::with('user')->with('post')->with('postsCount')->with('category')->orderBy('created_at', 'DESC')->paginate($pagination_results);
        if (isset($slug)) {
            $category = Category::where('slug', '=', $slug)->first();
            if (isset($category->id)) {
                $discussions = Discussion::with('user')->with('post')->with('postsCount')->with('category')->where('categorie_id', '=', $category->id)->orderBy('created_at', 'DESC')->paginate($pagination_results);
            }
        }

        $categories = Category::all();
        $chatter_editor = config('forum.editor');

// Dynamically register markdown service provider
//        \App::register('GrahamCampbell\Markdown\MarkdownServiceProvider');
        $cat_list = $categories;
        $s_categories = [0 => "== Sélectionnez le domaine de la question =="];
        foreach ($cat_list as $key => $value) {
            $s_categories[$value['id']] = $value['name'];
        }
        return view('forum.index', compact('discussions', 'categories', 'chatter_editor', 's_categories'));
    }

    public function getAjaxList(Request $request) {
//        $pagination_results = config('forum.paginate.num_of_results');
        $nb_by_page = config('forum.paginate.num_of_ajaxsearch');
        $input = $request->all();
        $last_id = (int) (isset($input['last']) ? $input['last'] : 0);
//        $page = (int) (isset($input['page']) ? $input['page'] : 1);

        $discussions = Discussion::where('id', '>', $last_id)->with('user')->with('post')->with('postsCount')->with('category')->orderBy('created_at', 'DESC')->simplepaginate($nb_by_page);
        return $this->HtmlConverte($discussions);
    }

    public function HtmlConverte($param) {
        $data = '';
        foreach ($param as $key => $discussion) {
//            echo config("kjkj");
            $avatar = config('forum.user.avatar_image_database_field');
            $data .= ' <li class="panel post list-card" id="' . $discussion->id . '">
                <div class="chatter_avatar panel-bodys">
                    <div class="row">
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="pad15">';
            if ($avatar) {
                $db_field = config('forum.user.avatar_image_database_field');

                if ((substr($discussion->user->{$db_field}, 0, 7) == 'http://') || (substr($discussion->user->{$db_field}, 0, 8) == 'https://')) {
                    $data .= ' <img src="' . $discussion->user->{$db_field} . '">';
                } else {
                    $img_url = config('forum.user.relative_url_to_image_assets') . $discussion->user->{$db_field};
                    $data .= '<img src="' . $img_url . '">';
                }
            } else {

                $data .= '<span class="avatar_circle" style="height:50px;width:50px;  background:#' . \App\Helpers\DataHelper::stringToColorCode($discussion->user->email) . '">
                                    ' . strtoupper(substr($discussion->user->email, 0, 1)) . '</span>';
            }
            $data .= '</div>
                        </div>
                        <div  class="col-xs-10 col-sm-10 col-md-10">
                            <div class="pad15_0 ">

                                <h5 class="user_info ">
                                    <a href="/user/">' . ucfirst($discussion->user->{config('forum.user.database_field_with_user_name')}) . '</a>
                                </h5>
                                <p class="user_post_date"> 
                                    ' . \Carbon\Carbon::createFromTimeStamp(strtotime($discussion->created_at))->diffForHumans() . '
                                </p>
                            </div>


                        </div>
                    </div>

                </div>';
            $body = collect($discussion->post)->toArray();

            $discussion_body = '';
            if (count($body)) {
                $discussion_body = $body[0]["body"];
            };
            $data .= '<div class="chatter_middle pad-panel">
                    <a class="discussion_list" href="/' . config('forum.routes.home') . '/' . config('forum.routes.discussion') . '/' . $discussion->category->slug . '/' . $discussion->slug . '">
                        <div class="middle_title">' . $discussion->title . '<div class="chatter_cat" style="background-color:' . $discussion->category->color . '">' . $discussion->category->name . '</div></div>
                    </a>
                    <p class="middle_content">  
                        <a class="discussion_list" href="/' . config('forum.routes.home') . '/' . config('forum.routes.discussion') . '/' . $discussion->category->slug . '/' . $discussion->slug . '">
                            ' . substr(strip_tags($discussion_body), 0, 200);
            $data .= (strlen(strip_tags($discussion_body)) > 200) ? '...' : '';
            $data .= '</a>
                        </p>
                </div>

                <div class="chatter_right">

                </div>

                <div class="chatter_clear"></div>
            </a>
            </li>';
        }
        return $data;
    }

}
