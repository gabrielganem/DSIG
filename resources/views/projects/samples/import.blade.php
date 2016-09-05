@extends('layouts.master')

@section('content')

<h1>Adicionar Amostra</h1>
<p class="lead">Adiciona um novo projeto de pesquisa</p>
<hr>

@include('partials.alerts.errors')

<form action="" class="form-horizontal" method="POST" enctype="multipart/form-data">
  <input type="file" name="datasheet">

<!-- Button -->
<div class="form-group">
  <label for="btn"></label>
      <button type="submit"  id="btn2" name="btn" class="btn btn-success">Importar</button>
</div>

</fieldset>
</form>
@stop
