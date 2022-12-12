<?php

namespace App\Http\Controllers;

use App\Models\Subsvcourse;
use Illuminate\Http\Request;

/**
 * Class SubsvcourseController
 * @package App\Http\Controllers
 */
class SubsvcourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subsvcourses = Subsvcourse::paginate();

        return view('subsvcourse.index', compact('subsvcourses'))
            ->with('i', (request()->input('page', 1) - 1) * $subsvcourses->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subsvcourse = new Subsvcourse();
        return view('subsvcourse.create', compact('subsvcourse'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Subsvcourse::$rules);

        $subsvcourse = Subsvcourse::create($request->all());

        return redirect()->route('subsvcourses.index')
            ->with('success', 'Subsvcourse created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subsvcourse = Subsvcourse::find($id);

        return view('subsvcourse.show', compact('subsvcourse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subsvcourse = Subsvcourse::find($id);

        return view('subsvcourse.edit', compact('subsvcourse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Subsvcourse $subsvcourse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subsvcourse $subsvcourse)
    {
        request()->validate(Subsvcourse::$rules);

        $subsvcourse->update($request->all());

        return redirect()->route('subsvcourses.index')
            ->with('success', 'Subsvcourse updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $subsvcourse = Subsvcourse::find($id)->delete();

        return redirect()->route('subsvcourses.index')
            ->with('success', 'Subsvcourse deleted successfully');
    }
}
