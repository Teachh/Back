@extends('layouts.app', ['page' => __('web.dashboard'), 'pageSlug' => 'dashboard'])

@section('content')
  <script type="text/javascript">
  // Meses pedidos
  var orders = @json($orders);
  function group_by_month(data) {
    var months = {
      '0':0,
      '1':0,
      '2':0,
      '3':0,
      '4':0,
      '5':0,
      '6':0,
      '7':0,
      '8':0,
      '9':0,
      '10':0,
      '11':0
  }  ;
    for (var i=0; i<data.length; i++) {
       var obj = data[i];
       var date = new Date(obj.date);
       var month = date.getMonth();
       if (months[month]) {
           months[month].push(obj);
       }
       else {
           months[month] = [obj];
       }
    }
    return months;
 }
 var ordersGroup = group_by_month(orders);
 // Productos mas pedidos
 var productosSueltos = [];
 function group_product(data) {
     var products = {};
     for (var i=0; i<data.length; i++) {
        var obj = data[i];
        var name = obj.name;
        if (products[name]) {
            products[name].push(obj); // añadirlo a una lista existente
        }
        else {
            products[name] = [obj];  // crear una nueva
        }
     }
     // meterlo en un array
     for(var key in products)
     {
       productosSueltos.push(key);
     }
     return products;
  }
  var productos = [];
  @foreach ($orders as $ord)
    productos.push(group_product(@json($ord->products)));
  @endforeach
  // ordenar
  function classify(a){
    var t = {};
    a.forEach(function(f){
        var txt = f.replace(/#/g,'').trim();
        var txtnode = document.createTextNode(f);

        t[txt] = (t[txt] || []).concat(txtnode);
    })
   return t;
}

var productosOrdeandos = classify(productosSueltos);
// ordenar ascendente
[].slice.call(productosOrdeandos).sort(function(a, b) {
    a = a[1];
    b = b[1];

    return a < b ? -1 : (a > b ? 1 : 0);
});
var ingredientesSueltos = [];
@foreach ($ingredientes as $ingr)
  ingredientesSueltos.push('{{$ingr}}');
@endforeach

var ingredientesOrdenados = classify(ingredientesSueltos);
// ordeanr ascendente
[].slice.call(ingredientesOrdenados).sort(function(a, b) {
    a = a[1];
    b = b[1];

    return a < b ? -1 : (a > b ? 1 : 0);
});
  </script>
    <div class="row">
        <div class="col-lg-12 col-md-12 order-1">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">{{__('web.tabla-pedidos')}}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter" id="">
                            <thead class=" text-primary text-center">
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
                            <tbody class="text-center">
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
                                            Si
                                        @endif
                                    </td>
                                    @if($order->finished==0)

                                    <td >
                                      <a href="{{ url('/pedidos/'.$order->id)}}">
                                        <button type="button" rel="tooltip" class="btn btn-success btn-link btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="{{ __('web.show-order') }}">
                                            <i class="tim-icons icon-zoom-split"></i>
                                        </button>
                                      </a>
                                        <button type="submit" class="btn btn-danger btn-link btn-icon btn-sm" style="display:inline" data-toggle="tooltip" data-placement="top" title="{{ __('web.delete-order') }}">
                                            <span class="tim-icons icon-trash-simple"></span>
                                        </button>
                                        <button type="submit" class="btn btn-success btn-link btn-icon btn-sm" style="display:inline" data-toggle="tooltip" data-placement="top" title="{{ __('web.order-delivered') }}">
                                            <span class="tim-icons icon-check-2"></span>
                                        </button>
                                    </td>

                                    @else
                                    <td>
                                      <a href="{{ url('/pedidos/'.$order->id)}}">
                                        <button type="button" rel="tooltip" class="btn btn-success btn-link btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="{{ __('web.show-order') }}">
                                            <i class="tim-icons icon-zoom-split"></i>
                                        </button>
                                      </a>
                                        <button type="submit" class="btn btn-danger btn-link btn-icon btn-sm" style="display:inline" data-toggle="tooltip" data-placement="top" title="{{ __('web.delete-order') }}">
                                            <span class="tim-icons icon-trash-simple"></span>
                                        </button>
                                    </td>


                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 order-2">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-12 text-left">
                            <!--<h5 class="card-category">test</h5>-->
                            <h2 class="card-title">{{__('web.tabla-mensual')}}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartBig1"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row order-2">
        <div class="col-lg-6 order-1">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">{{__('web.prod-est')}}</h5>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="CountryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 order-3">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">{{__('web.ing-usd')}}</h5>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartLineGreen"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 order-4">
            <div class="card card-tasks">
                <div class="card-header ">
                    <h6 class="title d-inline">{{__('web.notas')}}</h6>
                    <!--<p class="card-category d-inline">today</p>-->
                    <div class="dropdown">
                        <!-- Aqui va la MODAL -->
                        <button type="button" rel="tooltip" class="btn btn-link dropdown-toggle btn-icon" data-toggle="modal" data-target="#create">
                            <i class="tim-icons icon-simple-add"></i>
                        </button>
                        <!-- Modal

                        -->
                        <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                            <i class="tim-icons icon-settings-gear-63"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#pablo">Action</a>
                            <a class="dropdown-item" href="#pablo">Another action</a>
                            <a class="dropdown-item" href="#pablo">Something else</a>
                        </div>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <tbody>
                              @foreach($notes as $nota)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">{{$nota->title}} [{{ $nota->user->name}}]</p>
                                        <p class="text-muted">{{ $nota->subject}}</p>
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" class="btn btn-link" data-toggle="modal" data-target="#{{ str_replace(' ', '', $nota->title) }}view">
                                            <i class="tim-icons icon-zoom-split"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task" data-toggle="modal" data-target="#{{ str_replace(' ', '', $nota->title) }}edit">
                                            <i class="tim-icons icon-pencil"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task" data-toggle="modal" data-target="#{{ str_replace(' ', '', $nota->title) }}delete">
                                            <i class="tim-icons icon-simple-remove"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@foreach($notes as $nota)
  <!-- Modal -->
  <div class="modal fade" id="{{ str_replace(' ', '', $nota->title) }}delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('web.conf-eli')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        {{__('web.sure')}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('web.atras')}}</button>
          <form  action="{{action('TaskController@deleteDash', $nota->id)}}" method="POST" style="display:inline">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <button type="submit" class="btn btn-primary">{{__('web.acabado')}}</button>
          </form>
        </div>
      </div>
    </div>
  </div>


    <!-- Modal -->
<div class="modal fade" id="{{ str_replace(' ', '', $nota->title) }}edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: -100px;">
    <div class="modal-dialog" role="document">
      <div class="modal-content text-center">

<form class="w-85 text-center p-5"action="{{action('TaskController@putEditDash', $nota->id)}}"  method="post">
@csrf
<br style="clear:both">
                    <h3 style="margin-bottom: 25px; text-align: center;">{{__('web.editar')}}</h3>
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="title" value="{{$nota->title}}" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" name="subject" value="{{$nota->subject}}" required>
                    </div>
                    <div class="form-group">
                            <textarea class="form-control" type="textarea" name="body" id="message" maxlength="500" rows="7">{{$nota->body}}</textarea>
                        <span class="help-block"><p id="characterLeft" class="help-block ">{{__('web.error')}}</p></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="datepicker form-control" id="datetimepicker" name="limitdate" value="{{$nota->limitdate}}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-check-label">
                            @if($nota->priority==1)
                            <input class="form-check-input" type="checkbox" value="1" checked>
                            <span class="form-check-sign">
                            {{__('web.urgent')}}
                                <span class="check"></span>
                            </span>
                            @else
                            <input class="form-check-input" type="checkbox" value="0">
                            <span class="form-check-sign">
                            {{__('web.urgent')}}
                                <span class="check"></span>
                            </span>
                            @endif
                        </label>
                    </div>

        <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right">{{__('web.editar')}}</button>
</form>
      </div>
    </div>
  </div>


      <!-- Modal -->
      <div class="modal fade" id="{{ str_replace(' ', '', $nota->title) }}view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content text-center">

<form class="w-85 text-center p-5">
<br style="clear:both">
                    <h3 style="margin-bottom: 25px; text-align: center;"> {{$nota->title}} </h3>
                    <div class="form-group">
                        <h5> {{$nota->subject}} </h5>
                    </div>
                    <div class="form-group">
                        <p> {{$nota->body}} </p>
                    </div>
                    <div class="form-group">
                        <p> {{$nota->limitdate}} </p>
                    </div>
        <button type="button" id="submit" name="submit" class="btn btn-primary pull-right">{{__('web.acabado')}}</button>
</form>
      </div>
    </div>
  </div>
@endforeach

<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog mt-0 pt-0" role="document">
        <div class="modal-content text-center">
            <form class="w-85 text-center p-5" method="post">
                @csrf
                <br style="clear:both">
                    <h3 style="margin-bottom: 25px; text-align: center; color:grey;">Crear Tasca</h3>
                    <div class="form-group">
                        <label>TÍTOL</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="titol" required>
                    </div>
                    <div class="form-group">
                        <label>ASSUMPTE</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="assumpte" required>
                    </div>
                    <div class="form-group">
                        <label>COS</label>
                            <textarea class="form-control" type="textarea" id="message" name="message" placeholder="Message" maxlength="140" rows="7" style="color:grey;"></textarea>
                        <span class="help-block"><p id="characterLeft" class="help-block ">You have reached the limit</p></span>
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" id="datetimepicker" name="date" placeholder="Mobile Number" required>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" id="tipusUrgencia" name="tipusUrgencia" type="checkbox" value="0">
                            <span class="form-check-sign">
                                <span class="check">Urgent</span>
                            </span>
                        </label>
                    </div>
                <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right">Submit Form</button>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#datetimepicker').data("DateTimePicker").FUNCTION()
</script>
@endsection

@push('js')
    <script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script>
    <script>
        $(document).ready(function() {
          demo.initDashboardPageCharts();
        });
    </script>
@endpush
