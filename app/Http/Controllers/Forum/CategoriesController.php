<?php

namespace App\Http\Controllers\Forum;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Session;

class CategoriesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request) {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $categories = Category::where('user_id', 'LIKE', "%$keyword%")
                    ->orWhere('domaine_id', 'LIKE', "%$keyword%")
                    ->orWhere('image', 'LIKE', "%$keyword%")
                    ->orWhere('order', 'LIKE', "%$keyword%")
                    ->orWhere('name', 'LIKE', "%$keyword%")
                    ->orWhere('color', 'LIKE', "%$keyword%")
                    ->orWhere('slug', 'LIKE', "%$keyword%")
                    ->orWhere('description', 'LIKE', "%$keyword%")
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
    public function create() {
        return view('forum.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'min:3|max:250|required'
        ]);
        $requestData = $request->all();
        $requestData['slug'] = str_slug($requestData['slug']);

        if ($request->hasFile('image')) {
            $uploadPath = public_path('/uploads/' . config("forum.dossiers.category"));

            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;

            $request->file('image')->move($uploadPath, $fileName);
            $requestData['image'] = $fileName;
        }

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
    public function show($id) {
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
    public function edit($id) {
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
    public function update($id, Request $request) {
        $this->validate($request, [
            'name' => 'min:3|max:500|required'
        ]);
        $requestData = $request->all();


        if ($request->hasFile('image')) {
            $uploadPath = public_path('/uploads/' . config("forum.dossiers.category"));

            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;

            $request->file('image')->move($uploadPath, $fileName);

            $requestData['image'] = $fileName;
        }

        $category = Category::findOrFail($id);
        $requestData['slug'] = str_slug($requestData['name']);
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
    public function destroy($id) {
        Category::destroy($id);

        Session::flash('flash_message', 'Category deleted!');

        return redirect('categories');
    }

}
