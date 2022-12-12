<?php

namespace App\Http\Controllers;

use App\Models\Lendsfiel;
use App\Models\SField;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class LendsfielController
 * @package App\Http\Controllers
 */
class LendsfielController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lendsfiels = Lendsfiel::paginate();

        return view('lendsfiel.index', compact('lendsfiels'))
            ->with('i', (request()->input('page', 1) - 1) * $lendsfiels->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lendsfiel = new Lendsfiel();
        $sfields=SField::All();
        $denizens=User::where('id_rol',2);
        return view('lendsfiel.create', compact('lendsfiel','sfields', 'denizens'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Lendsfiel::$rules);

        $lendsfiel = Lendsfiel::create($request->all());

        return redirect()->route('lendsfiels.index')
            ->with('success', 'Lendsfiel created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lendsfiel = Lendsfiel::find($id);

        return view('lendsfiel.show', compact('lendsfiel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lendsfiel = Lendsfiel::find($id);

        return view('lendsfiel.edit', compact('lendsfiel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Lendsfiel $lendsfiel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lendsfiel $lendsfiel)
    {
        request()->validate(Lendsfiel::$rules);

        $lendsfiel->update($request->all());

        return redirect()->route('lendsfiels.index')
            ->with('success', 'Lendsfiel updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $lendsfiel = Lendsfiel::find($id)->delete();

        return redirect()->route('lendsfiels.index')
            ->with('success', 'Lendsfiel deleted successfully');
    }
}
