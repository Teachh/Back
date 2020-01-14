@extends('layouts.app')

@section('content')
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
                <button type="button" rel="tooltip" class="btn btn-success btn-link btn-icon btn-sm">
                    <i class="tim-icons icon-settings"></i>
                </button>
                <button type="button" rel="tooltip" class="btn btn-danger btn-link btn-icon btn-sm">
                    <i class="tim-icons icon-simple-remove"></i>
                </button>
            </td>
        </tr>
      @endforeach
    </tbody>
</table>
@endsection
