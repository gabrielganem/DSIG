@extends('layouts.master')

@section('content')

<h1>Adicionar Amostra</h1>
<p class="lead">Adiciona um novo projeto de pesquisa</p>
<hr>

@include('partials.alerts.errors')

<form action="/projects/{{ $projects->id }}/insereSample" class="form-horizontal" method="POST">

<fieldset>
<!-- Form Name -->
<legend>Nova Amostra</legend>
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
<!-- Text input-->
<div class="form-group">
  <label for="date">Data</label>
    <input id="date" name="date" type="date" class="form-control">
</div>

<div class="form-group">
  <label for="latitude">Latitude</label>
    <input id="latitude" name="latitude" type="number" placeholder="Latitude" class="form-control input-md">
  </div>

<div class="form-group">
  <label for="longitude">Longitude</label>
    <input id="longitude" name="longitude" type="number" placeholder="Longitude" class="form-control">
</div>

@foreach($projects->labels as $label)
<div class="form-group">
  <label for="{{$label->id}}">{{$label->title}}</label>
    <input id="{{$label->id}}" name="{{$label->id}}" type="text" placeholder="{{$label->unity}}" class="form-control">
</div>
@endforeach

<!-- Button -->
<div class="form-group">
  <label for="btn"></label>
    <button type="submit"  id="btn" name="btn" class="btn btn-primary">Criar Amostra</button>
</div>
</fieldset>
</form>
@stop
