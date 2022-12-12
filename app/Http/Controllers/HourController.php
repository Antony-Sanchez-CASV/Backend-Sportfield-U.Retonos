<?php

namespace App\Http\Controllers;

use App\Models\Hour;
use Illuminate\Http\Request;

/**
 * Class HourController
 * @package App\Http\Controllers
 */
class HourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hours = Hour::paginate();

        return view('hour.index', compact('hours'))
            ->with('i', (request()->input('page', 1) - 1) * $hours->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hour = new Hour();
        return view('hour.create', compact('hour'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Hour::$rules);

        $hour = Hour::create($request->all());

        return redirect()->route('hours.index')
            ->with('success', 'Hour created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hour = Hour::find($id);

        return view('hour.show', compact('hour'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hour = Hour::find($id);

        return view('hour.edit', compact('hour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Hour $hour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hour $hour)
    {
        request()->validate(Hour::$rules);

        $hour->update($request->all());

        return redirect()->route('hours.index')
            ->with('success', 'Hour updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $hour = Hour::find($id)->delete();

        return redirect()->route('hours.index')
            ->with('success', 'Hour deleted successfully');
    }
}
