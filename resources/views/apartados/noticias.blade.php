@extends('layouts.app', ['page' => __('web.articles'), 'pageSlug' => 'articles'])

@section('content')
  <div class="mb-3">
  <h3>{{ __('web.buscador') }}</h3>
          
  @include('alerts.success')

  <form action="{{ action('NoticiaController@searchDash') }}" method="GET">
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
  <a href="{{ route('noticias.create') }}">
    <button type="button" class="btn btn-primary">{{__('web.añadirNot')}}</button>
  </a>
  <table class="table">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>{{__('web.titulo')}}</th>
            <th class="text-center">{{__('web.content')}}</th>
            <th class="text-center">{{__('web.imagen')}}</th>
            <th class="text-right">{{__('web.opt')}}</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($noticias as $not)
        <tr>
            <td class="text-center">{{ $not->id }}</td>
            <td>{{ $not->title }}</td>
            <td>{{ (strlen($not->content) > 100)? substr($not->content,0,100).'...': $not->content}}</td>
            <td class="text-center">
              <img class=""src="{{ asset('assets/img/plates/' . $not->image) }}" alt="{{$not->image}}" width="150rem" height="75rem">
            </td>
            <td class="td-actions text-right">
                <a href="{{ url('noticias/edit/'. $not->id ) }}">
                  <button type="button" class="btn btn-success btn-link btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="{{ __('web.edit-article') }}"><i class="tim-icons icon-settings"></i></button>
                </a>
                    <button type="submit" class="btn btn-danger btn-link btn-icon btn-sm" style="display:inline" data-toggle="modal" data-placement="top" title="{{ __('web.delete-article') }}" data-target="#{{ str_replace(' ', '', $not->title) }}">
                        <span class="tim-icons icon-simple-remove"></span>
                    </button>
            </td>
        </tr>
      @endforeach
    </tbody>
</table>
@foreach ($noticias as $not)
  <!-- Modal -->
  <div class="modal fade" id="{{ str_replace(' ', '', $not->title) }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('web.back')}}</button>
          <form action="{{action('NoticiaController@deleteDash', $not->id)}}" method="POST" style="display:inline">
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
