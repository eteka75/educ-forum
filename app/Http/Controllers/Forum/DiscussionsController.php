<?php

namespace App\Http\Controllers\Forum;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Discussion;
use Illuminate\Http\Request;
use Session;

class DiscussionsController extends Controller
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
            $discussions = Discussion::where('categorie_id', 'LIKE', "%$keyword%")
				->orWhere('user_id', 'LIKE', "%$keyword%")
				->orWhere('parent_id', 'LIKE', "%$keyword%")
				->orWhere('title', 'LIKE', "%$keyword%")
				->orWhere('sticky', 'LIKE', "%$keyword%")
				->orWhere('views', 'LIKE', "%$keyword%")
				->orWhere('answered', 'LIKE', "%$keyword%")
				->orWhere('slug', 'LIKE', "%$keyword%")
				->orWhere('color', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $discussions = Discussion::paginate($perPage);
        }

        return view('forum.discussions.index', compact('discussions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('forum.discussions.create');
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
			'title' => 'min:10|max:500|required',
			'categorie_id' => 'required'
		]);
        $requestData = $request->all();
        
        Discussion::create($requestData);

        Session::flash('flash_message', 'Discussion added!');

        return redirect('discussions');
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
        $discussion = Discussion::findOrFail($id);

        return view('forum.discussions.show', compact('discussion'));
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
        $discussion = Discussion::findOrFail($id);

        return view('forum.discussions.edit', compact('discussion'));
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
			'title' => 'min:10|max:500|required',
			'categorie_id' => 'required'
		]);
        $requestData = $request->all();
        
        $discussion = Discussion::findOrFail($id);
        $discussion->update($requestData);

        Session::flash('flash_message', 'Discussion updated!');

        return redirect('discussions');
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
        Discussion::destroy($id);

        Session::flash('flash_message', 'Discussion deleted!');

        return redirect('discussions');
    }
}
