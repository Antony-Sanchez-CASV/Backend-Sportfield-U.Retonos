<?php

namespace App\Http\Controllers;

use App\Models\Svcourse;
use Illuminate\Http\Request;

/**
 * Class SvcourseController
 * @package App\Http\Controllers
 */
class SvcourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $svcourses = Svcourse::paginate();

        return view('svcourse.index', compact('svcourses'))
            ->with('i', (request()->input('page', 1) - 1) * $svcourses->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $svcourse = new Svcourse();
        return view('svcourse.create', compact('svcourse'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Svcourse::$rules);

        $svcourse = Svcourse::create($request->all());

        return redirect()->route('svcourses.index')
            ->with('success', 'Svcourse created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $svcourse = Svcourse::find($id);

        return view('svcourse.show', compact('svcourse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $svcourse = Svcourse::find($id);

        return view('svcourse.edit', compact('svcourse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Svcourse $svcourse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Svcourse $svcourse)
    {
        request()->validate(Svcourse::$rules);

        $svcourse->update($request->all());

        return redirect()->route('svcourses.index')
            ->with('success', 'Svcourse updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $svcourse = Svcourse::find($id)->delete();

        return redirect()->route('svcourses.index')
            ->with('success', 'Svcourse deleted successfully');
    }
}
