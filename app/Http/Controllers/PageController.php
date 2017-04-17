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
    public function index($category='',$slug='')
    {
        $total=10;
        $offset=6;
        $pagination_results= config('forum.paginate.num_of_results');;
        
        $discussions = Discussion::with('user')->with('posts')->with('postsCount')->with('category')->orderBy('created_at', 'DESC')->paginate($pagination_results);
       
        $categories=Category::all();
//        dd($discussions);
        $cat_list=$categories;
        $s_categories=[0=>"== Sélectionnez le domaine de la question =="];
        foreach ($cat_list as $key => $value) {
        $s_categories[$value['id']]=$value['name'];
        }

        if (isset($slug) && $slug!='') {

            $category = Category::where('slug', '=', $slug)->first();
            if (isset($category->id)) {
                $discussions = Discussion::with('user')->with('post')->with('postsCount')->with('category')->where('categorie_id',  $category->id)->orderBy('created_at', 'DESC')->paginate($pagination_results);
                
            }
        }
      
//       var_dump($discussions);
        return view('forum.index',['categories'=>$categories,'discussions'=>$discussions,'s_categories'=>$s_categories,'slug'=>$slug]);
    }
}
