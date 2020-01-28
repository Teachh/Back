@extends('layouts.app', ['page' => __('web.products'), 'pageSlug' => 'products'])

@section('content')
  <div class="mb-3">
  <h3>{{__('web.buscador')}}</h3>
        
  @include('alerts.success')

  <form action="{{ action('ProductController@searchDash') }}" method="GET">
    <div class="row">
      <div class="col-12 col-md-10">
        <input class="form-control" type="text" name="q" required/>
      </div>
      <div class="col-12 col-md-2" style="margin-top:-5px">
        <button type="submit" class="btn btn-primary mt-3 mt-sm-0">{{__('web.buscar')}}</button>
      </div>
    </div>

  </form>
</div>
  <a href="{{ route('products.create') }}">
    <button type="button" class="btn btn-primary">{{__('web.prod-ana')}}</button>
  </a>
  <table class="table">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>{{__('web.nombre')}}</th>
            <th>{{__('web.descrip')}}</th>
            <th>{{__('web.precio')}}</th>
            <th class="text-right">Stock</th>
            <th class="text-center">{{ __('web.active-date') }}</th>
            <th class="text-right">{{__('web.accio')}}</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($productos as $prod)
        <tr>
            <td class="text-center">{{ $prod->id }}</td>
            <td>{{ $prod->name }}</td>
            <td>{{ (strlen($prod->description) >= 20)? substr($prod->description,0,20).'...':$prod->description }}</td>
            <td>{{ $prod->price }}&euro;</td>
            <td class="text-right">{{ $prod->stock }}</td>
            <td class="text-center">{{ $prod->dateini }} - {{ $prod->dateend }}</td>

            <td class="td-actions text-right">
                <a href="{{ url('/productos/edit/'. $prod->id ) }}">
                  <button type="button" class="btn btn-success btn-link btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="{{ __('web.edit-product') }}"><i class="tim-icons icon-settings"></i></button>
                </a>
                    <button type="submit" class="btn btn-danger btn-link btn-icon btn-sm" style="display:inline" data-toggle="modal" data-placement="top" title="{{ __('web.delete-product') }}" data-target="#modal{{ $prod->id }}">
                        <span class="tim-icons icon-simple-remove"></span>
                    </button>
            </td>
        </tr>
      @endforeach
    </tbody>
</table>
@foreach ($productos as $prod)
  <!-- Modal -->
  <div class="modal fade" id="modal{{ $prod->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <form action="{{action('ProductController@deleteDash', $prod->id)}}" method="POST" style="display:inline">
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
