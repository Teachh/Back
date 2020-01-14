@extends('layouts.app')

@section('content')
  <script type="text/javascript">
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
  });
  </script>
<div class="card">
    <div class="card-body">
        <form>
            <div class="form-group">
                <label for="plato">Nombre del plato</label>
                <input name="plato" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Plat">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción del plato</label>
                <input name="descripcion" type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="precio">Precio</label>
                <input name="precio" type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input name="stock" type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <input name="categoria" type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
                <select class="js-example-basic-multiple" name="states[]" multiple="multiple">
                    <option value="AL">Alabama</option>
                    <option value="WY">Wyoming</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@endsection
