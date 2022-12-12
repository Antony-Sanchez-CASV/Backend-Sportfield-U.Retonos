<?php

namespace App\Http\Controllers;

use App\Models\SField;
use Illuminate\Http\Request;

/**
 * Class SFieldController
 * @package App\Http\Controllers
 */
class SFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sFields = SField::paginate();

        return view('s-field.index', compact('sFields'))
            ->with('i', (request()->input('page', 1) - 1) * $sFields->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sField = new SField();
        return view('s-field.create', compact('sField'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(SField::$rules);

        $sField = SField::create($request->all());

        return redirect()->route('s-fields.index')
            ->with('success', 'SField created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sField = SField::find($id);

        return view('s-field.show', compact('sField'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sField = SField::find($id);

        return view('s-field.edit', compact('sField'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  SField $sField
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SField $sField)
    {
        request()->validate(SField::$rules);

        $sField->update($request->all());

        return redirect()->route('s-fields.index')
            ->with('success', 'SField updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $sField = SField::find($id)->delete();

        return redirect()->route('s-fields.index')
            ->with('success', 'SField deleted successfully');
    }
}
