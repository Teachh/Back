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
            <div class="form-group">
                <label for="categoria">Nombre de la categoria</label>
                <input name="categoria" type="text" class="form-control" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection