@extends('layouts.master')

@section('content')

<h1>Criar Novo Projeto</h1>
<p class="lead">Adiciona um novo projeto de pesquisa</p>
<hr>

@include('partials.alerts.errors')


{!! Form::open
    (array
        ('route' => array('intermediate.adiciona', $projects->id), 
         'method' => 'post' )
    ) 
!!}

<div class="form-group">
    {!! Form::label('title', 'Título:', ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descrição:', ['class' => 'control-label']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('institute', 'Instituição:', ['class' => 'control-label']) !!}
    {!! Form::text('institute', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('department', 'Departamento:', ['class' => 'control-label']) !!}
    {!! Form::text('department', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit('Criar Novo Projeto', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@stop