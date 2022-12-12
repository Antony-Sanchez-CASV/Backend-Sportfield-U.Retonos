<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Hour;
use App\Models\Day;
//use App\Models\Hour;
use Illuminate\Http\Request;
use App\Http\Controllers\HourController;

/**
 * Class ScheduleController
 * @package App\Http\Controllers
 */
class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::paginate();

        return view('components.schedule.index', compact('schedules'))
        ->with('i', (request()->input('page', 1) - 1) * $schedules->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schedule = new Schedule();
        $days=Day::all();
        $hours1=Hour::where('hours',1);
        $hours2=Hour::where('hours',2);
        $hours3=Hour::where('hours',3);
        $hours=Hour::all();
        return view('components.schedule.create', compact('schedule','days','hours1','hours2','hours3','hours'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Schedule::$rules);

        $schedule = Schedule::create($request->all());

        return redirect()->route('schedules.index')
            ->with('success', 'Horario creado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = Schedule::find($id);

        return view('schedule.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedule = Schedule::find($id);

        return view('components.schedule.edit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        request()->validate(Schedule::$rules);

        $schedule->update($request->all());

        return redirect()->route('components.schedules.index')
            ->with('success', 'Schedule updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $schedule = Schedule::find($id)->delete();

        return redirect()->route('components.schedules.index')
            ->with('success', 'Schedule deleted successfully');
    }
 
}
