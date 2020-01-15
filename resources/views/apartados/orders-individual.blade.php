@extends('layouts.app')

@section('content')
<!--   <a href="{{ route('products.create') }}">
    <button type="button" class="btn btn-primary">Añadir producto</button>
  </a> -->
  <table class="table">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>USUARI</th>
            <th>PREU</th>
            <th>Precio</th>
            <th class="text-right">Stock</th>
            <th class="text-right">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            
            @foreach($order->products as $prod)
            <td class="text-center">{{ $order->id }}</td>
            <td>{{ $prod->name }}</td>
            <td>{{ $prod->pivot->Quantity }}</td>
            <td>{{ $order->price }}&euro;</td>
            <td class="text-right">{{ $order->date }}</td>
            <td class="td-actions text-right">
                <button type="button" rel="tooltip" class="btn btn-success btn-link btn-icon btn-sm">
                    <i class="tim-icons icon-settings"></i>
                </button>
<!--                 <form action="{{action('ProductController@deleteDash', $order->id)}}" method="POST" style="display:inline">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger btn-link btn-icon btn-sm" style="display:inline">
                        <span class="tim-icons icon-simple-remove"></span>
                    </button>
                </form> -->
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
