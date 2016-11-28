@extends('layouts.master')

@section('content')

<h1>Bem vindo ao DSIG</h1>
<p class="lead"> Ambiente para Monitoramento de Pesquisas e Dados Georreferenciados</p>
<hr>
@if (Auth::guest())
  <a href="{{ route('sample.filteredAmostras') }}" class="btn btn-info">Ver Amostras</a>
  <a href="{{ route('projects.index') }}" class="btn btn-info">Ver Projetos</a>
  <a href="{{ route('labels.index') }}" class="btn btn-info">Ver Etiquetas</a>
  <a href="{{ route('institutes.index') }}" class="btn btn-info">Ver Instituições</a>
@else
<a href="{{ route('projects.create') }}" class="btn btn-primary">Novo Projeto</a>
<a href="{{ route('projects.index') }}" class="btn btn-info">Ver Projetos</a>

<a href="{{ route('labels.create') }}" class="btn btn-primary">Nova Etiqueta</a>
<a href="{{ route('labels.index') }}" class="btn btn-info">Ver Etiquetas</a>

<a href="{{ route('institutes.index') }}" class="btn btn-info">Ver Instituições</a>

<a href="{{ route('sample.filteredAmostras') }}" class="btn btn-info">Ver Amostras</a>
@endif
@stop
