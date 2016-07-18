@extends('layouts.master')

@section('content')

<h1>Editar Projeto </h1>
<p class="lead">Editar o Projeto abaixo. <a href="{{ route('projects.index') }}">Voltar para Projetos.</a></p>
<hr>

@include('partials.alerts.errors')

{!! Form::model($projects, [
    'method' => 'PATCH',
    'route' => ['projects.update', $projects->id]
]) !!}

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

{!! Form::submit('Atualizar Projeto', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@stop