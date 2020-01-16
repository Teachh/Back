@extends('layouts.app')

@section('content')
  <div class="mb-3">
  <h3>Buscador</h3>
  <form action="productos/search" method="GET">
    <div class="row">
      <div class="col-12 col-md-10">
        <input class="form-control" type="text" name="q" required/>
      </div>
      <div class="col-12 col-md-2" style="margin-top:-5px">
        <button type="submit" class="btn btn-primary mt-3 mt-sm-0">Buscar</button>
      </div>
    </div>

  </form>
</div>
  <a href="{{ route('products.create') }}">
    <button type="button" class="btn btn-primary">Añadir producto</button>
  </a>
  <table class="table">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th class="text-right">Stock</th>
            <th class="text-right">Acciones</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($productos as $prod)
        <tr>
            <td class="text-center">{{ $prod->id }}</td>
            <td>{{ $prod->name }}</td>
            <td>{{ $prod->description }}</td>
            <td>{{ $prod->price }}&euro;</td>
            <td class="text-right">{{ $prod->stock }}</td>
            <td class="td-actions text-right">
                <a href="{{ url('/productos/edit/'. $prod->id ) }}">
                  <button type="button" class="btn btn-success btn-link btn-icon btn-sm"><i class="tim-icons icon-settings"></i></button>
                </a>
                <form action="{{action('ProductController@deleteDash', $prod->id)}}" method="POST" style="display:inline">
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
@endsection
