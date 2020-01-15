<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    public function indexDash(){
      $productos = Product::all();
      return view('apartados.products', compact('productos'));
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
      $producto = new Product();
      $producto->name = request('plato');
      $producto->description = request('descripcion');
      $producto->price = request('precio');
      $producto->stock = request('stock');
      $producto->image = request('imagen');
      $producto->category_id = request('categoria');
      $producto->save();
      $producto->ingredients()->sync(request('ingredientes'));
      return redirect('/productos');
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
      return Product::where('id', $id)->get();
    }

    public function searchDash(Request $request){
      $q = $request->input('q');

      $productos = Product::where('name', 'LIKE', '%' . $q . '%')->get();

      return view('apartados.products', compact('productos'));
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
        $producto = Product::findOrFail($id);
        $ingredients_array = [];
        foreach ($producto->ingredients as $ingredient){
            $ingredients_array[] = $ingredient->id;
        }
        return view('apartados.products-edit',compact('producto', 'ingredients_array'));
    }

    public function putEditDash(Request $request, $id)
    {
        $p = new Product;
        $o = $p -> findOrFail($id);
        $o->name = $request->input('plato');
        $o->description = $request->input('descripcion');
        $o->price = $request->input('precio');
        $o->stock = $request->input('stock');
        $o->image = $request->input('imagen');
        $o->category_id = request('categoria');
        $o->save();
        $o->ingredients()->sync(request('ingredientes'));

        $o = Product::findOrFail($id);

        return redirect('/productos');
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
        $p = new Product;
        $o = $p -> findOrFail($id);
        $o->delete();

        return redirect('/productos');
    }
}
