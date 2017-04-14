<?php

namespace App\Http\Controllers\Forum;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\Discussion as Discussion;
use Auth;

class UserController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function profil($category = '') {
        //dd(Auth::user());
        //return "Profil";
        return view('forum.user_profil', compact('discussion', 'posts', 'chatter_editor'));
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

}
