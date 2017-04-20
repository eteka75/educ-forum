<?php

namespace App\Http\Controllers\Forum;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Event;
use App\Http\Controllers\Controller;
use App\Models\Discussion as Discussion;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ChatterDiscussionUpdated;
use Validator;
use Carbon\Carbon;
use Session;

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

        $editor = config('forum.editor');

// Dynamically register markdown service provider
//\App::register('GrahamCampbell\Markdown\MarkdownServiceProvider');

        return view('forum.discussion', compact('discussion', 'posts', 'slug', 'editor', 's_categories'));
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
            return redirect(config('forum.routes.home'));
        }
        $numpage = config('forum.paginate.num_of_posts');
        $discussion = Discussion::where('slug', '=', $slug)->first();
        if (is_null($discussion)) {
            abort(404);
        }
        $discussion_category = Category::find($discussion->categorie_id);
        $blogKey = 'disc_' . $discussion->id;

// Check if blog session key exists
// If not, update view_count and create session key
        if (!Session::has($blogKey)) {
            Session::put($blogKey, 1);
            Discussion::where('id', $discussion->id)->increment('view_count');
//            dd(Session::get($blogKey));
        }
        if ($category != $discussion_category->slug) {
            return redirect(config('forum.routes.home') . '/' . config('forum.routes.discussion') . '/' . $discussion_category->slug . '/' . $discussion->slug);
        }
        $numpage = config('forum.paginate.num_of_posts');
        $posts = Post::with('user')->where('discussion_id', '=', $discussion->id)->orderBy('created_at', 'ASC')->paginate($numpage);
//        Event::fire('posts.view', $posts[0]);

        $editor = config('forum.editor');
        return view('forum.discussion', compact('discussion', 'posts', 'slug', 'editor'));
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
        $editor = config('forum.editor');

// Dynamically register markdown service provider
//        \App::register('GrahamCampbell\Markdown\MarkdownServiceProvider');
        $cat_list = $categories;
        $s_categories = [0 => "== Sélectionnez le domaine de la question =="];
        foreach ($cat_list as $key => $value) {
            $s_categories[$value['id']] = $value['name'];
        }
        return view('forum.showcategorie', compact('discussions', 'categories', 'slug', 'editor', 's_categories'));
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

    public function showAllSujets() {

        $pagination_results = config('forum.paginate.num_of_results');

        $discussions = Discussion::with('user')->with('posts')->with('postsCount')->with('category')->orderBy('created_at', 'DESC')->paginate($pagination_results);
        $categories = Category::all();
        $posts_nb = config('forum.paginate.posts_num_right');
        $posts_right = Discussion::with('user')->with('post')->with('category')->orderBy('created_at', 'DESC')->take($posts_nb)->orderBy('view_count', 'ASC')->paginate(12);

        return view('forum.allsujets', ['categories' => $categories, 'discussions' => $discussions, 'slug' => '','posts_right'=>$posts_right]);
    }

    public function showUserSujets($id = 0) {
        $user_id = (int) $id;
        if ($user_id < 1) {
            if (Auth::user()) {
                $user_id = Auth::user()->id;
            } else {
                abort(404);
            }
        }
        $pagination_results = config('forum.paginate.num_of_results');

        $discussions = Discussion::where('user_id', $user_id)->with('user')->with('posts')->with('postsCount')->with('category')->orderBy('created_at', 'DESC')->paginate($pagination_results);
        $categories = Category::all();
        return view('forum.usersujets', ['categories' => $categories, 'discussions' => $discussions, 'slug' => '']);
    }

    public function showFavorisSujets() {

        $pagination_results = config('forum.paginate.num_of_results');

        $discussions = Discussion::where('user_id')->with('user')->with('posts')->with('postsCount')->with('category')->orderBy('created_at', 'DESC')->paginate($pagination_results);
        $categories = Category::all();
        return view('forum.userfavoris', ['categories' => $categories, 'discussions' => $discussions, 'slug' => '']);
    }

    public function showAllCategory() {

        $pagination_results = config('forum.paginate.num_of_results');
        $pagination_categ = config('forum.paginate.num_of_cat_results');

        $discussions = Discussion::where('user_id')->with('user')->with('posts')->with('postsCount')->with('category')->orderBy('created_at', 'DESC')->paginate($pagination_results);
        $categories = Category::paginate($pagination_categ);
        return view('forum.allcategories', ['categories' => $categories, 'discussions' => $discussions, 'slug' => '']);
    }

    public function showUserDiscussions($id = 0) {
        $user_id = (int) $id;
        if ($user_id < 1) {
            if (Auth::user()) {
                $user_id = Auth::user()->id;
            } else {
                abort(404);
            }
        }
        $pagination_results = config('forum.paginate.num_of_results');

        $discussions = Discussion::where('user_id', $user_id)->with('user')->with('posts')->with('postsCount')->with('category')->orderBy('created_at', 'DESC')->paginate($pagination_results);
        $categories = Category::all();
        return view('forum.userdiscussions', ['categories' => $categories, 'discussions' => $discussions, 'slug' => '']);
    }

    public function SaveComment(Request $request) {
        $stripped_tags_body = ['body' => strip_tags($request->body)];
        $validator = Validator::make($stripped_tags_body, [
                    'body' => 'required|min:10',
        ]);

        //Event::fire(new ChatterBeforeNewResponse($request, $validator));
//        if (function_exists('before_new_response')) {
//            before_new_response($request, $validator);
//        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (config('forum.security.limit_time_between_posts')) {
            if ($this->notEnoughTimeBetweenPosts()) {
                $minute_copy = (config('forum.security.time_between_posts') == 1) ? ' minute' : ' minutes';
                $alert = [
                    'alert_type' => 'danger',
                    'danger' => 'In order to prevent spam, please allow at least ' . config('forum.security.time_between_posts') . $minute_copy . ' in between submitting content.',
                ];

                return back()->with($alert)->withInput();
            }
        }

        $request->request->add(['user_id' => Auth::user()->id]);

        if (config('forum.editor') == 'simplemde'):
            $request->request->add(['markdown' => 1]);
        endif;

        $discussion = Discussion::find($request->discussion_id);
        $new_post = Post::create($request->all());
//        dd($request->all());

        $category = Category::find($discussion->categorie_id);
        if (!isset($category->slug)) {
            $category = Category::first();
        }

        if ($new_post->id) {
//            Event::fire(new ChatterAfterNewResponse($request));
//            if (function_exists('after_new_response')) {
//                after_new_response($request);
//            }
            // if email notifications are enabled
            if (config('forum.email.enabled')) {
                // Send email notifications about new post
                $this->sendEmailNotifications($new_post->discussion);
            }

            $alert = [
                'alert_type' => 'success',
                'alert' => 'Message envoyé à  ' . config('forum.titles.discussion') . '.',
            ];

            return redirect('/' . config('forum.routes.home') . '/' . config('forum.routes.discussion') . '/' . $category->slug . '/' . $discussion->slug)->with($alert);
        } else {
            $alert = [
                'alert_type' => 'danger',
                'alert' => 'Sorry, there seems to have been a problem submitting your response.',
            ];

            return redirect('/' . config('forum.routes.home') . '/' . config('forum.routes.discussion') . '/' . $category->slug . '/' . $discussion->slug)->with($alert);
        }
        dd($request);
    }

    private function sendEmailNotifications($discussion) {
        $users = $discussion->users->except(Auth::user()->id);
        foreach ($users as $user) {
            Mail::to($user)->queue(new ChatterDiscussionUpdated($discussion));
        }
    }

    private function notEnoughTimeBetweenPosts() {
        $user = Auth::user();

        $past = Carbon::now()->subMinutes(config('forum.security.time_between_posts'));

        $last_post = Post::where('user_id', '=', $user->id)->where('created_at', '>=', $past)->first();

        if (isset($last_post)) {
            return true;
        }

        return false;
    }

}
