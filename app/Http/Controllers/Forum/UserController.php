<?php

namespace App\Http\Controllers\Forum;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\Discussion as Discussion;
use Auth;
use App;

class UserController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function profil($id = '') {

        if ($id >= 1) {
            $user = \App\User::where('id', $id)->first();
            if (!$user) {
                abort(404);
            }
        } else {
            if (Auth::user()) {
                $user = Auth::user();
            } else {
                abort(404);
            }
        }
//        dd($user);
        $da = config("app.name", $user->name . '');
        $pagination_results = config('forum.paginate.num_of_results');
        ;

        $discussions = Discussion::where('user_id', $user->id)->with('user')->with('posts')->with('postsCount')->with('category')->orderBy('created_at', 'DESC')->paginate($pagination_results);


        return view('forum.user_profil', compact('discussions', 'user'));
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
        return view('forum.index', compact('discussions', 'categories', 'chatter_editor'));
    }

    public function NewSujet() {
        $categories = Category::all();
//        dd($discussions);
        $cat_list = $categories;
        $s_categories = [0 => "== Sélectionnez le domaine de la question =="];
        foreach ($cat_list as $key => $value) {
            $s_categories[$value['id']] = $value['name'];
        }
        return view('forum.newsujet', compact('categories', 's_categories'));
    }
    public function userNotifications() {
        $categories = Category::all();
//        dd($discussions);
        $cat_list = $categories;
        $s_categories = [0 => "== Sélectionnez le domaine de la question =="];
        foreach ($cat_list as $key => $value) {
            $s_categories[$value['id']] = $value['name'];
        }
        return view('forum.newsujet', compact('categories', 's_categories'));
    }
    public function FaqForum() {
        $categories = Category::all();
//        dd($discussions);
        $cat_list = $categories;
        $s_categories = [0 => "== Sélectionnez le domaine de la question =="];
        foreach ($cat_list as $key => $value) {
            $s_categories[$value['id']] = $value['name'];
        }
        return view('forum.newsujet', compact('categories', 's_categories'));
    }
    public function SettingProfil() {
        $categories = Category::all();
//        dd($discussions);
        $cat_list = $categories;
        $s_categories = [0 => "== Sélectionnez le domaine de la question =="];
        foreach ($cat_list as $key => $value) {
            $s_categories[$value['id']] = $value['name'];
        }
        return view('forum.newsujet', compact('categories', 's_categories'));
    }

}
