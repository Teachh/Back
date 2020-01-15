@extends('layouts.app')

@section('content')
  <a href="{{ route('products.create') }}">
    <button type="button" class="btn btn-primary">Añadir Ingredientes</button>
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
      @foreach ($ingredients as $ingr)
        <tr>
            <td class="text-center">{{ $ingr->id }}</td>
            <td>{{ $ingr->name }}</td>
            <td class="td-actions text-right">
                <button type="button" rel="tooltip" class="btn btn-success btn-link btn-icon btn-sm">
                    <i class="tim-icons icon-settings"></i>
                </button>
                <form action="{{action('ProductController@deleteDash', $ingr->id)}}" method="POST" style="display:inline">
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
