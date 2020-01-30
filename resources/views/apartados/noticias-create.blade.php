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
            <div class="form-group">
                <label for="noticia">{{__('web.notTitulo')}}</label>
                <input name="noticia" type="text" class="form-control @error('noticia') is-invalid @enderror" aria-describedby="emailHelp">

                @error('noticia')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="contenido">{{__('web.notContent')}}</label>
                <input name="contenido" type="text" class="form-control @error('contenido') is-invalid @enderror">

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
            <div class="form-group">
                <label for="actiu">{{__('web.activo')}}</label>
                <input name="actiu" type="checkbox" class="form-control @error('activo') is-invalid @enderror">
                @error('activo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{__('web.crear')}}</button>
        </form>
    </div>
</div>

@endsection
