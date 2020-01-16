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
                <form action="{{action('MessageController@deleteDash', $msj->id)}}" method="POST" style="display:inline">
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
