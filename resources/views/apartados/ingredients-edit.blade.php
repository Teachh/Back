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
                <label for="ingrediente">Nombre del ingrediente</label>
                <input name="ingrediente" type="text" class="form-control @error('plato') is-invalid @enderror" aria-describedby="emailHelp" value="{{$ingrediente->name}}">

                @error('ingredient')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection