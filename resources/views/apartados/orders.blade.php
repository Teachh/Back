@extends('layouts.app')

@section('content')
<div class="mb-3">
  <h3>{{ __('web.buscador') }}</h3>
        
  @include('alerts.success')

  <form action="{{action('OrderController@searchDash')}}" method="GET">
    <div class="row">
      <div class="col-12 col-md-10">
        <input class="form-control" type="number" name="q" required/>
      </div>
      <div class="col-12 col-md-2" style="margin-top:-5px">
        <button type="submit" class="btn btn-primary mt-3 mt-sm-0">{{ __('web.buscar') }}</button>
      </div>
    </div>

  </form>
</div>
<table class="table">
    <thead>
      <tr>
          <th>
            {{__('web.pedido')}}
          </th >
          <th>
            {{__('web.usuario')}}
          </th>
          <th>
          {{__('web.precio')}}
          </th>
          <th>
          {{__('web.fecha')}}
          </th>
          <th>
          {{__('web.entregado')}}
          </th>
          <th>
          {{__('web.opciones')}}
          </th>
      </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
          @if(($order->finished==0))
          <tr class="bg-order-red">
          @else
          <tr class="bg-order-green">
          @endif
              <td>
                {{ $order->id }}
              </td>
              <td>
                {{ $order->user->name }}
              </td>
              <td>
                {{ $order->price }}
              </td>
              <td>
                {{ $order->date }}
              </td>
              <td>
                  @if(($order->finished==0))
                      No
                  @else
                      {{ __('web.yes') }}
                  @endif
              </td>
              @if($order->finished==0)

              <td >
                <a href="{{ url('/pedidos/'.$order->id)}}">
                  <button type="button" rel="tooltip" class="btn btn-success btn-link btn-icon btn-sm">
                      <i class="tim-icons icon-zoom-split"></i>
                  </button>
                </a>
                  <button type="submit" class="btn btn-danger btn-link btn-icon btn-sm" style="display:inline">
                      <span class="tim-icons icon-trash-simple"></span>
                  </button>
                  <button type="submit" class="btn btn-success btn-link btn-icon btn-sm" style="display:inline">
                      <span class="tim-icons icon-check-2"></span>
                  </button>
              </td>

              @else
              <td>
                <a href="{{ url('/pedidos/'.$order->id)}}">
                  <button type="button" rel="tooltip" class="btn btn-success btn-link btn-icon btn-sm">
                      <i class="tim-icons icon-zoom-split"></i>
                  </button>
                </a>
                  <button type="submit" class="btn btn-danger btn-link btn-icon btn-sm" style="display:inline">
                      <span class="tim-icons icon-trash-simple"></span>
                  </button>
              </td>


              @endif
          </tr>
        @endforeach

    </tbody>
</table>
@foreach ($orders as $ord)
  <!-- Modal -->
  <div class="modal fade" id="{{ $ord->name }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> {{__('web.conf-eli')}} </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{__('web.sure')}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('web.atras')}}</button>
          <form action="{{action('IngredientController@deleteDash', $ord->id)}}" method="POST" style="display:inline">
              {{ method_field('PUT') }}
              {{ csrf_field() }}
              <button type="submit" class="btn btn-primary">{{__('web.elim')}}</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endforeach
@endsection
