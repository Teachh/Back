<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Allergen;

class AllergenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Allergen::all();
    }
    public function indexDash()
    {
        $alergenos = Allergen::all();
        return view('apartados.allergens', compact('alergenos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return Allergen::where('id', $id)->get();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function searchDash(Request $request)
    {
        $q = $request->input('q');

        $alergenos = Allergen::where('name', 'LIKE', '%' . $q . '%')->get();

        return view('apartados.allergens', compact('alergenos'));
    }
    public function createDash(Request $request)
    {
        $this->validate($request, [
            'allergen' => ['required']
        ]);

        $alergeno = new Allergen();
        $alergeno->name = request('allergen');
        $alergeno->save();
        return redirect('/alergenos');
    }
    public function getEditDash($id)
    {
        $alergeno = Allergen::findOrFail($id);
        return view('apartados.allergens-edit', compact('alergeno'));
    }

    public function putEditDash(Request $request, $id)
    {
        $this->validate($request, [
            'alergeno' => ['required']
        ]);

        $i = new Allergen;
        $o = $i->findOrFail($id);
        $o->name = $request->input('alergeno');
        $o->save();

        $o = Allergen::findOrFail($id);

        return redirect('alergenos');
    }

    public function deleteDash($id)
    {
        $p = new Allergen;
        $o = $p->findOrFail($id);
        $o->delete();

        return redirect('/alergenos');
    }

}
