@extends('layouts.app')

@section('content')
<!--   <a href="{{ route('products.create') }}">
    <button type="button" class="btn btn-primary">Añadir producto</button>
  </a> -->
  <div class="container mb-3 mb-sm-5 text-right">
  <div class="row ">
    <div class="col-md-5 details mt-4 text-center align-self-center">
        <h1 class="mb-0">NUM PEDIDO: {{ $order->id }}</h1><br>
        <h1>ENTREGAT:
            @if(($order->finished==0))
                No
            @else
                Sí
            @endif
        </h1>

    </div>
    <div class="col-md-4 details mt-2 align-self-center ">
      <blockquote class="mb-0 mr-4 mr-sm-0">
        <h5 class="mb-0">{{ $order->user->name }}</h5>
        <small><cite title="Source Title">{{ $order->user->email }}<i class="icon-map-marker"></i></cite></small>
      </blockquote>
    </div>
    <div class="col-md-3 img w-100 h-100">
      <img src="{{ asset('black') }}/img/{{ $order->user->avatar }}"  alt="" class="img-rounded mr-4 mr-sm-0 mt-3 mt-sm-0" style="width: 245px; height: 230px;">
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
            <th>ELIMINAR</th>
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
                <button type="button" rel="tooltip" class="btn btn-danger btn-link btn-icon btn-sm">
                    <i class="tim-icons icon-simple-remove"></i>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
  <div class="container mb-5 text-right">
  <div class="row ">
    <div class="col-md-12 col-lg-2 details mt-4 text-center mr-0 mr-xs-5" >
            @if(($order->finished==0))
                <button type="button" class="btn btn-primary">Entregar</button>
            @else
                <button type="button" class="btn btn-primary">Cancelar</button>
            @endif
    </div>
    <div class=" col-md-12 col-lg-2 details mt-4 text-center">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Eliminar</button>
    </div>
    <div class="col-md-12 col-xs-5 col-sm-7 ml-sm-2 ml-md-0 col-lg-4 details mt-4 ">
        <h1 class="text-center" id="preutotal">TOTAL:  {{ $price }} &euro;</h1>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmacio d'eliminació</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Estas segur que vols eliminar aquesta comanda?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tornar</button>
        <button type="button" class="btn btn-primary">Eliminar</button>
      </div>
    </div>
  </div>
</div>
@endsection
