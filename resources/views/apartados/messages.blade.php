@extends('layouts.app')

@section('content')
<div class="mb-3">
    <h3>Buscador</h3>
    <form action="mensajes/search" method="GET">
        <div class="row">
            <div class="col-12 col-md-10">
                <input class="form-control" type="text" name="q" required />
            </div>
            <div class="col-12 col-md-2" style="margin-top:-5px">
                <button type="submit" class="btn btn-primary mt-3 mt-sm-0">Buscar</button>
            </div>
        </div>

    </form>
</div>
<table class="table">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Título</th>
            <th>Mensaje</th>
            <th>Fecha</th>
            <th class="text-right">Usuario</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mensajes as $msj)
        <tr>
            <td class="text-center">{{ $msj->id }}</td>
            <td>{{ $msj->title }}</td>
            <td>{{ $msj->body }}</td>
            <td>{{ $msj->date }}</td>
            <td class="text-right">{{ $msj->user_id }}</td>
            <td class="td-actions text-right">
                    <button type="submit" class="btn btn-danger btn-link btn-icon btn-sm" style="display:inline" data-toggle="modal" data-placement="top" title="Eliminar Ingredient" data-target="#{{ str_replace(' ', '', $msj->title) }}">
                        <span class="tim-icons icon-simple-remove"></span>
                    </button>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
@foreach ($mensajes as $msj)
  <!-- Modal -->
  <div class="modal fade" id="{{ str_replace(' ', '', $msj->title) }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <form action="{{action('MessageController@deleteDash', $msj->id)}}" method="POST" style="display:inline">
              {{ method_field('PUT') }}
              {{ csrf_field() }}
              <button type="submit" class="btn btn-primary">Eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endforeach
@endsection
