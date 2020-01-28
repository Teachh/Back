<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use File;
use App\Allergen;
use App\Ingredient;

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

    public function indexDash()
    {
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
    public function createDash(Request $request)
    {
        $this->validate($request, [
            'plato' => ['required', 'string'],
            'descripcion' => ['required'],
            'precio' => ['required', 'alpha_num'],
            'stock' => ['required', 'integer'],
            'imagen' => ['required', 'image'],
            'categoria' => ['required'],
            'ingredientes' => ['required']
        ]);

        $image = $request->file('imagen');
        $original_path = public_path() . '/assets/img/plates';
        $filename = time() . $image->getClientOriginalName();
        $image->move($original_path, $filename);

        $producto = new Product();
        $producto->name = request('plato');
        $producto->description = request('descripcion');
        $producto->price = request('precio');
        $producto->stock = request('stock');
        $producto->image = $filename;
        $producto->category_id = request('categoria');
        $producto->save();
        $producto->ingredients()->sync(request('ingredientes'));
        if (request('allergens')) {
            $producto->allergens()->sync(request('allergens'));
        }

        return redirect('/productos')->withStatus(__('web.product-created'));
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
        // ingredientes
        $ingrInternos = Product::findOrFail($id)->ingredients;
        $ingredientes = '';
        foreach ($ingrInternos as $key => $value) {
          $ingredientes .= $value->name . ',';
        }
        // alergenos
        $alergInternos = Product::findOrFail($id)->allergens;
        $alergenos = '';
        foreach ($alergInternos as $key => $value) {
          $alergenos .= $value->name  . ',';
        }
        // quitar coma
        $ingredientes = substr_replace($ingredientes ,'',-1);
        $alergenos = substr_replace($alergenos ,'',-1);
        return [Product::where('id', $id)->get(),$ingredientes, $alergenos ];
    }

    public function searchDash(Request $request)
    {
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
        foreach ($producto->ingredients as $ingredient) {
            $ingredients_array[] = $ingredient->id;
        }
        $allergens_array = [];
        foreach ($producto->allergens as $allergen) {
            $allergens_array[] = $allergen->id;
        }
        return view('apartados.products-edit', compact('producto', 'ingredients_array', 'allergens_array'));
    }

    public function putEditDash(Request $request, $id)
    {
        $this->validate($request, [
            'plato' => ['required', 'string'],
            'descripcion' => ['required'],
            'precio' => ['required', 'alpha_num'],
            'stock' => ['required', 'integer'],
            'categoria' => ['required'],
            'dateini' => ['required'],
            'dateend' => ['required'],
            'ingredientes' => ['required']
        ]);

        $p = new Product;
        $o = $p->findOrFail($id);
        $o->name = $request->input('plato');
        $o->description = $request->input('descripcion');
        $o->price = $request->input('precio');
        $o->stock = $request->input('stock');
        $o->dateini = $request->input('dateini');
        $o->dateend = $request->input('dateend');
        if ($request->file('imagen')) {
            // delete product's image
            $image = public_path() . '/assets/img/plates/' . $o->image;
            if (File::exists($image)) {
                File::delete($image);
            }

            $image = $request->file('imagen');
            $original_path = public_path() . '/assets/img/plates';
            $filename = time() . $image->getClientOriginalName();
            $image->move($original_path, $filename);
            $o->image = $filename;
        }
        $o->category_id = request('categoria');
        $o->save();
        $o->ingredients()->sync(request('ingredientes'));
        if (request('allergens')) {
            $o->allergens()->sync(request('allergens'));
        } else {
            $o->allergens()->detach();
        }

        $o = Product::findOrFail($id);

        return redirect('/productos')->withStatus(__('web.product-updated'));
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
        $o = $p->findOrFail($id);

        // delete product's image
        $image = public_path() . '/assets/img/plates/' . $o->image;
        if (File::exists($image)) {
            File::delete($image);
        }

        $o->ingredients()->detach();
        $o->allergens()->detach();
        $o->delete();

        return redirect('/productos')->withStatus(__('web.product-deleted'));
    }
}
