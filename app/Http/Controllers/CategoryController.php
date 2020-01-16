<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::all();
    }

    public function indexDash()
    {
        $categories = Category::paginate(20);
        return view('apartados.categories', compact('categories'));
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
            'categoria' => ['required']
        ]);

        $categoria = new Category();
        $categoria->name = request('categoria');
        $categoria->save();
        return redirect('/categorias')->withStatus(__('Category successfully deleted.'));
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
        $categoria = Category::findOrFail($id);
        return view('apartados.categories-edit', compact('categoria'));
    }

    public function putEditDash(Request $request, $id)
    {
        $this->validate($request, [
            'categoria' => ['required']
        ]);

        $i = new Category;
        $o = $i->findOrFail($id);
        $o->name = $request->input('categoria');
        $o->save();

        $o = Category::findOrFail($id);

        return redirect('/categorias')->withStatus(__('Category successfully deleted.'));
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
        $p = new Category;
        $o = $p->findOrFail($id);
        $o->delete();

        return redirect('/categorias')->withStatus(__('Category successfully deleted.'));
    }

    public function searchDash(Request $request)
    {
        $q = $request->input('q');

        $categories = Category::where('name', 'LIKE', '%' . $q . '%')->paginate(20);

        return view('apartados.categories', compact('categories'));
    }
}
