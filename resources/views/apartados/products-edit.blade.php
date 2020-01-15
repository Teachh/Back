@extends('layouts.app')

@section('content')
  <script type="text/javascript">
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
  });
  </script>
<div class="card">
    <div class="card-body">
        <form method="POST">
          @csrf
          {{method_field('PUT')}}

            <div class="form-group">
                <label for="plato">Nombre del plato</label>
                <input name="plato" type="text" class="form-control" aria-describedby="emailHelp" value="{{$producto->name}}">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción del plato</label>
                <input name="descripcion" type="text" class="form-control" value="{{$producto->description}}">
            </div>
            <div class="form-group">
                <label for="precio">Precio</label>
                <input name="precio" type="number" class="form-control" value="{{$producto->price}}">
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input name="stock" type="number" class="form-control" value="{{$producto->stock}}">
            </div>
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input name="imagen" type="text" class="form-control" placeholder="ES UN PROBLEMA PARA EL HECTOR DEL FUTURO">
            </div>
            <div class="form-group">
              <label for="categoria">Categorias</label>
              <select class="js-example-basic-single form-control" name="categoria">
                  @foreach (App\Category::all() as $cat)
                    <option {{ $producto->category_id == $cat->id ? 'selected' : '' }} value="{{$cat->id}}">{{$cat->name}}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="categoria">Ingredients</label>
                <select class="js-example-basic-multiple form-control" name="ingredientes[]" multiple="multiple">
                    @foreach (App\Ingredient::all() as $ingr)
                      <option value="{{$ingr->id}}" {{ in_array($ingr->id, $ingredients_array) ? 'selected' : '' }}>{{$ingr->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@endsection
