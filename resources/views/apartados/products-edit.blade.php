@extends('layouts.app', ['page' => __('web.products'), 'pageSlug' => 'products'])

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
          @csrf
          {{method_field('PUT')}}

            <div class="form-group">
                <label for="plato">{{__('web.nom-pla')}}</label>
                <input name="plato" type="text" class="form-control @error('plato') is-invalid @enderror" aria-describedby="emailHelp" value="{{$producto->name}}">

                @error('plato')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="descripcion">{{__('web.des-pla')}}</label>
                <input name="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" value="{{$producto->description}}">

                @error('descripcion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="dateini">{{ __('web.start-date') }}</label>
                <input name="dateini" type="text" class="datepicker form-control @error('dateini') is-invalid @enderror" value="{{$producto->dateini}}">

                @error('dateini')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="dateend">{{ __('web.end-date') }}</label>
                <input name="dateend" type="text" class="datepicker form-control @error('dateend') is-invalid @enderror" value="{{$producto->dateend}}">

                @error('dateend')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="precio">{{__('web.precio')}}</label>
                <input name="precio" type="number" class="form-control @error('precio') is-invalid @enderror" value="{{$producto->price}}">

                @error('precio')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input name="stock" type="number" class="form-control @error('stock') is-invalid @enderror" value="{{$producto->stock}}">

                @error('stock')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            @if ($producto->image)
                <div class="form-image-container">
                    <img src="{{ asset('assets/img/plates/' . $producto->image) }}" alt="imatge producte"/>
                </div>
            @endif

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
              <label for="categoria">{{__('web.catego')}}</label>
              <select class="js-example-basic-single form-control @error('categoria') is-invalid @enderror" name="categoria">
                  @foreach (App\Category::all() as $cat)
                    <option {{ $producto->category_id == $cat->id ? 'selected' : '' }} value="{{$cat->id}}">{{$cat->name}}</option>
                  @endforeach
              </select>

              @error('categoria')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="ingredientes">{{__('web.ingre')}}</label>
                <select class="js-example-basic-multiple form-control @error('ingredientes') is-invalid @enderror" name="ingredientes[]" multiple="multiple">
                    @foreach (App\Ingredient::all() as $ingr)
                      <option value="{{$ingr->id}}" {{ in_array($ingr->id, $ingredients_array) ? 'selected' : '' }}>{{$ingr->name}}</option>
                    @endforeach
                </select>

                @error('ingredientes')
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
