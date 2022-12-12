<?php

namespace App\Http\Controllers;

use App\Models\Ssfield;
use Illuminate\Http\Request;

/**
 * Class SsfieldController
 * @package App\Http\Controllers
 */
class SsfieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ssfields = Ssfield::paginate();

        return view('ssfield.index', compact('ssfields'))
            ->with('i', (request()->input('page', 1) - 1) * $ssfields->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ssfield = new Ssfield();
        return view('ssfield.create', compact('ssfield'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Ssfield::$rules);

        $ssfield = Ssfield::create($request->all());

        return redirect()->route('ssfields.index')
            ->with('success', 'Ssfield created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ssfield = Ssfield::find($id);

        return view('ssfield.show', compact('ssfield'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ssfield = Ssfield::find($id);

        return view('ssfield.edit', compact('ssfield'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ssfield $ssfield
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ssfield $ssfield)
    {
        request()->validate(Ssfield::$rules);

        $ssfield->update($request->all());

        return redirect()->route('ssfields.index')
            ->with('success', 'Ssfield updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ssfield = Ssfield::find($id)->delete();

        return redirect()->route('ssfields.index')
            ->with('success', 'Ssfield deleted successfully');
    }
}
