<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Noticia;
use File;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticias = Noticia::all();
        foreach ($noticias as $not){
            $not->content_long = $not->content;
            $not->content = (strlen($not->content) > 24)? substr($not->content,0,24).'...': $not->content;
        }
        return $noticias;
    }

    public function indexDash()
    {
        $noticias = Noticia::all();
        return view('apartados.noticias', compact('noticias'));
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
        return Noticia::where('id', $id)->get();
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
        $noticias = Noticia::where(function ($query) use ($q) {
            $query->where('title', 'LIKE', '%' . $q . '%')
                ->orWhere('content', 'LIKE', '%' . $q . '%');
        })->get();

        return view('apartados.noticias', compact('noticias'));
    }

    public function createDash(Request $request)
    {
        $this->validate($request, [
            'noticia' => ['required', 'string'],
            'contenido' => ['required'],
            'imagen' => ['required', 'image'],
            'activo' => ['boolean']
        ]);

        $image = $request->file('imagen');
        $original_path = public_path() . '/assets/img/plates';
        $filename = time() . $image->getClientOriginalName();
        $image->move($original_path, $filename);

        $noticia = new Noticia();
        $noticia->title = request('noticia');
        $noticia->content = request('contenido');
        $noticia->image = $filename;
        if(request('actiu')=="on")
        {
            $noticia->activo = 1;
        } 
        else 
        {
            $noticia->activo = 0;
        }
        $noticia->save();

        return redirect('/noticias')->withStatus(__('web.article-created'));
    }
    public function deleteDash($id)
    {
        $p = new Noticia;
        $o = $p->findOrFail($id);

        // delete product's image
        $image = public_path() . '/assets/img/plates/' . $o->image;
        if (File::exists($image)) {
            File::delete($image);
        }

        $o->delete();

        return redirect('/noticias')->withStatus(__('web.article-deleted'));
    }
    public function getEditDash($id)
    {
        $noticia = Noticia::findOrFail($id);
        return view('apartados.noticias-edit', compact('noticia'));
    }

    public function eyeDash(Request $request, $id)
    {
        $p = new Noticia;
        $o = $p->findOrFail($id);
        if(request('actiu')=="on"){
            $o->activo = 1;
        } else {
            $o->activo = 0;
        }
        $o->save();
        $o = Noticia::findOrFail($id);
        return redirect('/noticias')->withStatus(__('web.article-updated'));
    }

    public function putEditDash(Request $request, $id)
    {
        $p = new Noticia;
        $o = $p->findOrFail($id);
        $o->title = request('noticia');
        $o->content = request('contenido');
        if(request('actiu')=="on"){
            $o->activo = 1;
        } else {
            $o->activo = 0;
        }
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
        $o->save();

        $o = Noticia::findOrFail($id);

        return redirect('/noticias')->withStatus(__('web.article-updated'));
    }
}
