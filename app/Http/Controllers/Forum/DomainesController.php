<?php

namespace App\Http\Controllers\Forum;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Domaine;
use Illuminate\Http\Request;
use Session;

class DomainesController extends Controller
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
            $domaines = Domaine::where('name', 'LIKE', "%$keyword%")
				->orWhere('description', 'LIKE', "%$keyword%")
				->orWhere('slug', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $domaines = Domaine::paginate($perPage);
        }

        return view('forum.domaines.index', compact('domaines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('forum.domaines.create');
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
			'name' => 'min:10|max:500|required',
			'slug' => 'min:5|required'
		]);
        $requestData = $request->all();
        
        Domaine::create($requestData);

        Session::flash('flash_message', 'Domaine added!');

        return redirect('domaines');
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
        $domaine = Domaine::findOrFail($id);

        return view('forum.domaines.show', compact('domaine'));
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
        $domaine = Domaine::findOrFail($id);

        return view('forum.domaines.edit', compact('domaine'));
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
			'name' => 'min:10|max:500|required',
			'slug' => 'min:5|required'
		]);
        $requestData = $request->all();
        
        $domaine = Domaine::findOrFail($id);
        $domaine->update($requestData);

        Session::flash('flash_message', 'Domaine updated!');

        return redirect('domaines');
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
        Domaine::destroy($id);

        Session::flash('flash_message', 'Domaine deleted!');

        return redirect('domaines');
    }
}
