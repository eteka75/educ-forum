<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Discussion as Discussion;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total=10;
        $offset=6;
        $pagination_results=10;
        

        $discussions = Discussion::with('user')->with('post')->with('postsCount')->with('category')->orderBy('created_at', 'DESC')->paginate($pagination_results);
       
        $categories=Category::limit(20)->orderBy('order')->get();

        if (isset($slug)) {
            $category = Category::where('slug', '=', $slug)->first();
            if (isset($category->id)) {
                $discussions = Discussion::with('user')->with('post')->with('postsCount')->with('category')->where('chatter_category_id', '=', $category->id)->orderBy('created_at', 'DESC')->paginate($pagination_results);
                dd('ll');
            }
        }
        //dd($discussions);
        foreach ($discussions as $key => $discussion) {
            # code...
            dd($discussion->);
            print_r($discussion->category);
        }

       //var_dump($discussions);
        return view('forum.index',['categories'=>$categories,'discussions'=>$discussions]);
    }
}
