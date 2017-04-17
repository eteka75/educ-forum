<?php

namespace App\Http\Controllers\Forum;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Discussion;
use App\Models\Category;
use App\Models\Post;

use Session;
use Validator;
use Auth;

class SujetsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $posts = Post::where('discussion_id', 'LIKE', "%$keyword%")
				->orWhere('user_id', 'LIKE', "%$keyword%")
				->orWhere('body', 'LIKE', "%$keyword%")
				->orWhere('markdown', 'LIKE', "%$keyword%")
				->orWhere('locked', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $posts = Post::paginate($perPage);
        }

        return view('forum.posts.index', compact('posts'));
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function NewSujet(Request $request)
    {
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'min:5|required',
            'categorie' => 'integer|min:1|required'
		]);
        $stripped_tags_body = ['body' => strip_tags($request->body)];
        $validator = Validator::make($stripped_tags_body, [
            'body' => 'min:10|max:5500|required'
        ]);
        
        //Event::fire(new ChatterBeforeNewResponse($request, $validator));
        if (function_exists('chatter_before_new_response')) {
            chatter_before_new_response($request, $validator);
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $requestData = $request->all();
        //Ajout de l'id de l'utilisateur
        $user_id=Auth::user()->id;
        $request->request->add(['user_id' => Auth::user()->id]);
        //Couleur
        $request->request->add(['color' => '#524152']);
        if (config('forum.editor') == 'simplemde'):
            $request->request->add(['markdown' => 1]);
        endif;
        $slug = str_slug($request->title, '-');
        $discussion_exists = Discussion::where('slug', '=', $slug)->first();
        $incrementer = 1;
        $new_slug = $slug;
        while (isset($discussion_exists->id)) {
            $new_slug = $slug.'-'.$incrementer;
            $discussion_exists = Discussion::where('slug', '=', $new_slug)->first();
            $incrementer += 1;
        }
        if ($slug != $new_slug) {
            $slug = $new_slug;
        }
         $new_discussion = [
            'title'               => $request->title,
            'user_id'             => $request->user_id,
            'categorie_id'        => $request->categorie,            
            'slug'                => $slug,
            'color'               => $request->color,
            ];
         //   dd($new_discussion);
        $category = Category::find($request->categorie);
        if (!isset($category->slug)) {
            $category = Category::first();
        }

        $discussion = Discussion::create($new_discussion);

        $new_post = [
            'discussion_id' => $discussion->id,
            'user_id'               => $user_id,
            'body'                  => $request->body,
            ];
        $discussion->users()->attach($user_id);

        $post = Post::create($new_post);
        if ($post->id) {
            //Event::fire(new ChatterAfterNewDiscussion($request));
            if (function_exists('chatter_after_new_discussion')) {
                chatter_after_new_discussion($request);
            }

            $chatter_alert = [
                'chatter_alert_type' => 'success',
                'chatter_alert'      => 'Successfully created a new '.config('forum.titles.discussion').'.',
                ];

            return redirect(config('forum.routes.home').'/'.config('forum.routes.discussion').'/'.$category->slug.'/'.$slug)->with($chatter_alert);
        } else {
            $chatter_alert = [
                'chatter_alert_type' => 'danger',
                'chatter_alert'      => 'Whoops :( There seems to be a problem creating your '.config('forum.titles.discussion').'.',
                ];

            return redirect('/'.config('forum.routes.home').'/'.config('forum.routes.discussion').'/'.$category->slug.'/'.$slug)->with($chatter_alert);
        }
        dd($request->all());
        //Post::create($requestData);

        Session::flash('flash_message', 'Post added!');

        return redirect('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('forum.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('forum.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
			'body' => 'min:10|max:5500|required',
			'discussion_id' => 'required'
		]);
        $requestData = $request->all();
        
        $post = Post::findOrFail($id);
        $post->update($requestData);

        Session::flash('flash_message', 'Post updated!');

        return redirect('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Post::destroy($id);

        Session::flash('flash_message', 'Post deleted!');

        return redirect('posts');
    }
}
