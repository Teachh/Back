@extends('layouts.app')

@section('content')
  <script type="text/javascript">
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
  });
  </script>
<div class="card">
    <div class="card-body">
        <form method="post">
          @csrf
          {{method_field('PUT')}}
            <div class="form-group">
                <label for="alergeno">{{__('web.nom-ale')}}</label>
                <input name="alergeno" type="text" class="form-control @error('alergeno') is-invalid @enderror" aria-describedby="emailHelp" value="{{$alergeno->name}}">
                @error('alergeno')
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