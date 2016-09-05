@extends('layouts.master')

@section('content')

<h1>Adicionar Amostra</h1>
<p class="lead">Adiciona um novo projeto de pesquisa</p>
<hr>

@include('partials.alerts.errors')

<form action="/projects/{{ $projects->id }}/samples/Excel" class="form-inline" method="POST" enctype="multipart/form-data">
  <fieldset>
  <!-- Form Name -->
  <legend>Importar Amostras</legend>
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
<div class="col-xs-8">
  <label class="sr_only" for="datasheet"></label>
  <input type="file" class="form-control" name="datasheet">
  <label for="btn2"></label>
  <input type="submit"  id="btn2" name="btn2" class="btn btn-success" value="Importar"></button>
</div>
</fieldset>
</form>
<br />


<form action="/projects/{{ $projects->id }}/insereSample" class="form-horizontal" method="POST">

<fieldset>

<!-- Form Name -->
<legend>Nova Amostra</legend>
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
<!-- Text input-->
<div class="form-group">
  <div class="col-xs-4">
    <label for="date">Data</label>
      <input id="date" name="date" type="datetime-local" class="form-control">
  </div>

  <div class="col-xs-2">
    <label for="latitude">Latitude</label>
      <input id="latitude" name="latitude" type="number" step="any" placeholder="Latitude" class="form-control input-md">
    </div>

  <div class="col-xs-2">
    <label for="longitude">Longitude</label>
      <input id="longitude" name="longitude" type="number" step="any" placeholder="Longitude" class="form-control">
  </div>
</div>
</fieldset>

<fieldset>
<legend>Campos</legend>
<div class="form-group">
  @foreach($projects->labels as $label)
  <div class="col-sm-4">
  <div class="input-group">
    <label class="sr-only" for="{{$label->id}}">{{$label->title}}</label>
    <div class="input-group-addon">{{$label->title}}</div>
      <input id="{{$label->id}}" name="{{$label->id}}" type="text" placeholder="{{$label->unity}}" class="form-control">
    </div>
  <br />
</div>
  @endforeach
</div>

<div class="form-group">
  <label for="btn"></label>
    <button type="submit"  id="btn" name="btn" class="btn btn-success">Criar Amostra</button>
</div>
</fieldset>

</form>


@stop
