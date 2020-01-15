@extends('layouts.app')

@section('content')
<!--   <a href="{{ route('products.create') }}">
    <button type="button" class="btn btn-primary">Añadir producto</button>
  </a> -->
  <div class="container mb-5 text-right">
  <div class="row ">
    <div class="col-md-5 details mt-4 text-center align-self-center">
        <h1 class="mb-0">NUM PEDIDO: {{ $order->id }}</h1><br>

    </div>
    <div class="col-md-4 details mt-2 align-self-center ">
      <blockquote class="mb-0">
        <h5 class="mb-0">{{ $order->user->name }}</h5>
        <small><cite title="Source Title">#ID Usuario:{{ $order->user->id }}<i class="icon-map-marker"></i></cite></small>
      </blockquote>
      <p>
        {{ $order->user->email }}<br>
      </p>
    </div>
    <div class="col-md-3 img">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRvzOpl3-kqfNbPcA_u_qEZcSuvu5Je4Ce_FkTMMjxhB-J1wWin-Q"  alt="" class="img-rounded">
    </div>
  </div>
</div>
<br>
  <table class="table">
    <thead class="text-center">
        <tr>
            <th>ID PROD</th>
            <th>PRODUCTO</th>
            <th>CANTIDAD</th>
            <th>PRECIO</th>
            <th>OPCIONES</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <tr>
            @foreach($order->products as $prod)
            <td >{{ $prod->id }}</td>
            <td>{{ $prod->name }}</td>
            <td>{{ $prod->pivot->Quantity }}</td>
            <td>{{ $prod->price }}&euro;</td>
            <td class="td-actions text-center">
                <button type="button" rel="tooltip" class="btn btn-success btn-link btn-icon btn-sm">
                    <i class="tim-icons icon-settings"></i>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
  <div class="container mb-5 text-right">
  <div class="row ">
    <div class="col-md-12 col-lg-2 details mt-4 text-center mr-0 mr-xs-5" >
            <button type="submit" class="btn btn-primary">Entregat</button>
    </div>
    <div class=" col-md-12 col-lg-2 details mt-4 text-center">
            <button type="submit" class="btn btn-primary">Eliminar</button>
    </div>
    <div class="col-md-12 col-sm-7 ml-sm-2 ml-md-0 col-lg-4 details mt-4">
        <h1>TOTAL: </h1>
    </div>
  </div>
</div>
@endsection
