<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredient;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ingredient::all();
    }

    public function indexDash(){
      $ingredients = Ingredient::paginate(20);
      return view('apartados.ingredients', compact('ingredients'));
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
    public function createDash(Request $request){
      $ingrediente = new Ingredient();
      $ingrediente->name = request('ingrediente');
      $ingrediente->save();
      return redirect('/ingredientes');
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
        //
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

    public function getEditDash($id)
    {
        $ingrediente = Ingredient::findOrFail($id);
        return view('apartados.ingredients-edit',compact('ingrediente',));
    }

    public function putEditDash(Request $request, $id)
    {
        $i = new Ingredient;
        $o = $i -> findOrFail($id);
        $o->name = $request->input('ingrediente');
        $o->save();

        $o = Ingredient::findOrFail($id);

        return redirect('/ingredientes');
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

    public function deleteDash($id)
    {
        $p = new Ingredient;
        $o = $p -> findOrFail($id);
        $o->delete();

        return redirect('/ingredientes');
    }

    public function searchDash(Request $request){
      $q = $request->input('q');

      $ingredients = Ingredient::where('name', 'LIKE', '%' . $q . '%')->paginate(20);

      return view('apartados.ingredients', compact('ingredients'));
    }

}
