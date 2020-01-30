@extends('layouts.app', ['page' => __('web.dashboard'), 'pageSlug' => 'dashboard'])

@section('content')
  <script type="text/javascript">
  // Meses pedidos
  var orders = @json($orderss);
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
                        <div id="orders-table">
                            @include('ajax.orders')
                        </div>
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
            <div class="card card-tasks h-auto">
                <div class="card-header ">
                    <h6 id="modalTask" class="title d-inline">{{__('web.notas')}}</h6>
                    <!--<p class="card-category d-inline">today</p>-->
                    <div class="dropdown">
                        <!-- Aqui va la MODAL -->
                        <button type="button" rel="tooltip" class="btn btn-link dropdown-toggle btn-icon" data-toggle="modal" data-target="#create">
                            <i class="tim-icons icon-simple-add"></i>
                        </button>
                        <!-- Modal

                        -->
                    </div>
                </div>
                <div class="card-body ">
                    <div class="table-full-width table-responsive">
                        <div id="tasks-table">
                            @include('ajax.tasks')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: -100px;">
    <div class="modal-dialog mt-0 pt-0" role="document">
        <div class="modal-content text-center">
            <form class="w-85 text-center p-5" method="post">
                @csrf
                <br style="clear:both">
                    <h3 style="margin-bottom: 25px; text-align: center; color:grey;">Crear Tasca</h3>
                    <div class="form-group">
                        <label>{{__('web.notaTitu')}}</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="{{__('web.notaTitu')}}" required>
                    </div>
                    <div class="form-group">
                        <label>{{__('web.notaAssu')}}</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="{{__('web.notaAssu')}}" required>
                    </div>
                    <div class="form-group">
                        <label>{{__('web.cos')}}</label>
                            <textarea class="form-control" type="textarea" id="message" name="message" placeholder="{{__('web.mensaje')}}" maxlength="140" rows="7" style="color:grey;"></textarea>
                        <span class="help-block"><p id="characterLeft" class="help-block ">You have reached the limit</p></span>
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" id="datetimepicker" name="date" placeholder="Mobile Number" required>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" id="tipusUrgencia" name="tipusUrgencia" type="checkbox" value="0">
                            <span class="form-check-sign">
                                <span class="check">{{__('web.urgent')}}</span>
                            </span>
                        </label>
                    </div>
                <button type="submit" id="submit3" name="submit" class="btn btn-primary pull-right w-100">CREAR</button>
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
