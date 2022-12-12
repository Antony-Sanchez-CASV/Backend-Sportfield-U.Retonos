<?php

namespace App\Http\Controllers;

use App\Models\Day;
use Illuminate\Http\Request;

/**
 * Class DayController
 * @package App\Http\Controllers
 */
class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $days = Day::all();

        return view('components.day.index', compact('days'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $day = new Day();
        return view('day.create', compact('day'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Day::$rules);

        $day = Day::create($request->all());

        return redirect()->route('days.index')
            ->with('success', 'Day created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $day = Day::find($id);

        return view('day.show', compact('day'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $day = Day::find($id);

        return view('day.edit', compact('day'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Day $day
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Day $day)
    {
        request()->validate(Day::$rules);

        $day->update($request->all());

        return redirect()->route('days.index')
            ->with('success', 'Day updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $day = Day::find($id)->delete();

        return redirect()->route('days.index')
            ->with('success', 'Day deleted successfully');
    }
    //funciones
    public function getName(){
        return '$this->name';
    }
}
