@extends('layouts.app', ['page' => __('web.categories'), 'pageSlug' => 'categories'])

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
                <label for="categoria">{{__('web.nombreCAT')}}</label>
                <input name="categoria" type="text" class="form-control @error('categoria') is-invalid @enderror" aria-describedby="emailHelp">

                @error('categoria')
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