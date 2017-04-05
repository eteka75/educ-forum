<?php

namespace App\Http\Controllers\Forum;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;
use Session;

class CategoriesController extends Controller
{
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
            $categories = Category::where('user_id', 'LIKE', "%$keyword%")
				->orWhere('parent_id', 'LIKE', "%$keyword%")
				->orWhere('order', 'LIKE', "%$keyword%")
				->orWhere('name', 'LIKE', "%$keyword%")
				->orWhere('color', 'LIKE', "%$keyword%")
				->orWhere('slug', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $categories = Category::paginate($perPage);
        }

        return view('forum.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('forum.categories.create');
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
			'name' => 'min:10|max:500|required'
		]);
        $requestData = $request->all();
        
        Category::create($requestData);

        Session::flash('flash_message', 'Category added!');

        return redirect('categories');
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
        $category = Category::findOrFail($id);

        return view('forum.categories.show', compact('category'));
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
        $category = Category::findOrFail($id);

        return view('forum.categories.edit', compact('category'));
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
			'name' => 'min:10|max:500|required'
		]);
        $requestData = $request->all();
        
        $category = Category::findOrFail($id);
        $category->update($requestData);

        Session::flash('flash_message', 'Category updated!');

        return redirect('categories');
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
        Category::destroy($id);

        Session::flash('flash_message', 'Category deleted!');

        return redirect('categories');
    }
}
