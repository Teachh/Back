@extends('layouts.app', ['page' => __('web.articles'), 'pageSlug' => 'articles'])

@section('content')
  <script type="text/javascript">
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
  });
  </script>
<div class="card">
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
          @csrf
          {{method_field('PUT')}}
            <div class="form-group">
                <label for="noticia">{{__('web.notTitulo')}}</label>
                <input name="noticia" type="text" class="form-control @error('noticia') is-invalid @enderror" aria-describedby="emailHelp" value="{{$noticia->title}}">

                @error('noticia')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="contenido">{{__('web.notContent')}}</label>
                <input name="contenido" rows="8" cols="80" type="text" class="form-control @error('contenido') is-invalid @enderror" value="{{$noticia->content}}">

                @error('contenido')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="imagen">{{__('web.imagen')}}</label>
                <input name="imagen" type="file" class="form-control @error('imagen') is-invalid @enderror">

                @error('imagen')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{__('web.editar')}}</button>
        </form>
    </div>
</div>

@endsection
