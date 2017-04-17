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

        return view('forum.discussion', compact('discussion', 'posts','slug', 'chatter_editor', 's_categories'));
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

        return view('forum.discussion', compact('discussion', 'posts','slug', 'chatter_editor'));
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
        return view('forum.showcategorie', compact('discussions', 'categories','slug', 'chatter_editor', 's_categories'));
    }

    public function getAjaxList(Request $request) {
//        $pagination_results = config('forum.paginate.num_of_results');
        $nb_by_page = config('forum.paginate.num_of_ajaxsearch');
        $input = $request->all();
        $last_id = (int) (isset($input['last']) ? $input['last'] : 0);
//        $page = (int) (isset($input['page']) ? $input['page'] : 1);

        $discussions = Discussion::where('id', '<', $last_id)->with('user')->with('post')->with('postsCount')->with('category')->orderBy('created_at', 'DESC')->simplepaginate($nb_by_page);
        return \App\Helpers\HtmlRender::HtmlConvertePost($discussions);
    }

    

}
