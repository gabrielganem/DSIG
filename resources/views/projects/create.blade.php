@extends('layouts.projects')

@section('content')

<h1>Criar Novo Projeto</h1>
<p class="lead">Adiciona um novo projeto de pesquisa</p>
<hr>

@include('partials.alerts.errors')

<form action="/intermediate/adiciona" class="form-horizontal" method="POST">

<fieldset>
<!-- Form Name -->
<legend>Novo Projeto</legend>
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
<!-- Text input-->
<div class="form-group">
  <label for="title">Título</label>
    <input id="title" name="title" type="text" placeholder="Nome do Projeto" class="form-control">
</div>

<div class="form-group">
  <label for="description">Descrição</label>
    <textarea id="description" rows="5" name="description" type="textarea" placeholder="Descrição" class="form-control input-md"></textarea>
  </div>

<div class="form-group">
  <label for="institute">Instituição</label>
    <input id="institute" name="institute" type="text" placeholder="Instituição" class="form-control">
</div>

<div class="form-group">
  <labelfor="department">Departamento</label>
    <input id="department" name="department" type="text" placeholder="Departamento" class="form-control">
</div>

<!-- Multiple Checkboxes -->
<div class="form-group">
  <label for="etiqueta">Etiquetas</label>
    @foreach($labels->all() as $label)
      <div class="checkbox">
        <label for="label-{{$label->id}}">
          <input type="checkbox" name="label-{{$label->id}}" id="label-{{$label->id}}" value="{{$label->id}}">
          {{$label->title}} || {{$label->unity}}
        </label>
      </div>
    @endforeach
</div>

<!-- Button -->
<div class="form-group">
  <label for="btn"></label>
    <button type="submit"  id="btn" name="btn" class="btn btn-primary">Criar Projeto</button>
</div>
</fieldset>
</form>
@stop
