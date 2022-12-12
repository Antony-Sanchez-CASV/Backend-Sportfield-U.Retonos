<?php

namespace App\Http\Controllers;

use App\Models\Vcourse;
use App\Models\Instructor;
use App\Models\Room;
use App\Models\Activity;
use Illuminate\Http\Request;

/**
 * Class VcourseController
 * @package App\Http\Controllers
 */
class VcourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vcourses = Vcourse::paginate(5);

        return view('course.vcourse.index', compact('vcourses'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vcourse = new Vcourse();
        $ins=Instructor::all();
        foreach($ins as $in){
            $instructors[]=$in->getName();
        }
        $rooms=Room::pluck('located','id');
        $activities=Activity::all();
        return view('course.vcourse.create', compact('vcourse','instructors','rooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Vcourse::$rules);

        $vcourse = Vcourse::create($request->all());

        return redirect()->route('course.vcourses.index')
            ->with('success', 'Vcourse created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vcourse = Vcourse::find($id);

        return view('course.vcourse.show', compact('vcourse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vcourse = Vcourse::find($id);

        return view('course.vcourse.edit', compact('vcourse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Vcourse $vcourse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vcourse $vcourse)
    {
        request()->validate(Vcourse::$rules);

        $vcourse->update($request->all());

        return redirect()->route('course.vcourses.index')
            ->with('success', 'Vcourse updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $vcourse = Vcourse::find($id)->delete();

        return redirect()->route('course.vcourses.index')
            ->with('success', 'Vcourse deleted successfully');
    }
}
