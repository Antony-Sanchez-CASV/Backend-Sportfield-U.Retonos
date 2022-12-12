<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Vcourse;
use Illuminate\Http\Request;

/**
 * Class InstructorController
 * @package App\Http\Controllers
 */
class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructors = Instructor::paginate();

        return view('layouts.instructor.index', compact('instructors'))
            ->with('i', (request()->input('page', 1) - 1) * $instructors->perPage())->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instructor = new Instructor();
        return view('layouts.instructor.create', compact('instructor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Instructor::$rules);

        $instructor = Instructor::create($request->all());

        return redirect()->route('layouts.instructors.index')
            ->with('success', 'Instructor created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $instructor = Instructor::find($id);
        $vcourses=Vcourse::where('id_instructor',$id);
        return view('layouts.instructor.show', compact('instructor','vcourses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $instructor = Instructor::find($id);

        return view('layouts.instructor.edit', compact('instructor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Instructor $instructor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instructor $instructor)
    {
        request()->validate(Instructor::$rules);

        $instructor->update($request->all());

        return redirect()->route('layouts.instructors.index')
            ->with('success', 'Instructor updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $instructor = Instructor::find($id)->delete();

        return redirect()->route('layouts.instructors.index')
            ->with('success', 'Instructor deleted successfully');
    }
}
