@extends('layouts.master')

@section('content')

<h1>Cadastrar Instituição </h1>
<p class="lead">Cadastrar a Instituição. <a href="{{ route('projects.index') }}">Voltar para Projetos.</a></p>
<hr>

@include('partials.alerts.errors')

{!! Form::open([
    'route' => 'institutes.store'
]) !!}

<div class="form-group">
    {!! Form::label('name', 'Nome:', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('abreviature', 'Abreviatura:', ['class' => 'control-label']) !!}
    {!! Form::text('abreviature', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit('Cadastrar Instituição', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@stop
