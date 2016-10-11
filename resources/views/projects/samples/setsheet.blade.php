@extends('layouts.master')

@section('content')

<h1>Gerar Planilha</h1>
<p class="lead">Fornece uma planilha em branco para inserir amostras</p>
<hr>
@include('partials.alerts.errors')


<form action="/projects/{{ $projects->id }}/samples/setExcel" class="form-horizontal" method="POST" enctype="multipart/form-data">
  <fieldset>
  <!-- Form Name -->
  <legend>Gerar Planilha</legend>
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

<div class="form-group">
    <div class="col-xs-4">
      @for ($i = 0; $i < $npontos; $i++)
      <label for="x-{{$i}}">Ponto {{$i}}</label>
        <input id="x-{{$i}}" name="x-{{$i}}" type="number" placeholder="Latitude {{$i}}" class="form-control">
        <input id="y-{{$i}}" name="y-{{$i}}" type="number" placeholder="Longitude {{$i}}" class="form-control">
      @endfor
    </div>
</div>
<div class="form-group">
    <div class="col-xs-4">
      <label for="date">Data Inicial</label>
        <input id="date" name="date" type="datetime-local" class="form-control">
    </div>

    <div class="col-xs-2">
      <label for="periodo">Período (em dias)</label>
        <input id="periodo" name="periodo" type="number" placeholder="Dias" class="form-control">
    </div>
</div>
    <div class="col-xs-8">
      <label for="btn2"></label>
      <input type="submit"  id="btn3" name="btn3" class="btn btn-success" value="Avançar"></button>
    </div>
</fieldset>
</form>
<br />

@stop
