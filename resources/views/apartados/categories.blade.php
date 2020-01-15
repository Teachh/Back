@extends('layouts.app')

@section('content')

<div class="mb-3">
  <h3>Buscador</h3>
  <form action="/categories/search" method="GET">
    <div class="row">
      <div class="col-12 col-md-10">
        <input class="form-control" type="text" name="q" required/>
      </div>
      <div class="col-12 col-md-2" style="margin-top:-5px">
        <button type="submit" class="btn btn-primary">Buscar</button>
      </div>
    </div>

  </form>
</div>
<a href="{{ route('categorias.create') }}">
    <button type="button" class="btn btn-primary">Añadir Categorias</button>
</a>
<table class="table">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Nombre</th>
            <th class="text-right">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $categ)
        <tr>
            <td class="text-center">{{ $categ->id }}</td>
            <td>{{ $categ->name }}</td>
            <td class="td-actions text-right">
                <a href="{{ url('/categorias/edit/'. $categ->id ) }}">
                  <button type="button" class="btn btn-success btn-link btn-icon btn-sm"><i class="tim-icons icon-settings"></i></button>
                </a>
                <form action="{{action('CategoryController@deleteDash', $categ->id)}}" method="POST" style="display:inline">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger btn-link btn-icon btn-sm" style="display:inline">
                        <span class="tim-icons icon-simple-remove"></span>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $categories->links() }}
@endsection