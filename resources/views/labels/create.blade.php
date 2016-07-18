@extends('layouts.master')

@section('content')

<h1>Criar Nova Etiqueta</h1>
<p class="lead">Adiciona uma nova etiqueta</p>
<hr>

@include('partials.alerts.errors')

{!! Form::open([
    'route' => 'labels.store'
]) !!}

<div class="form-group">
    {!! Form::label('title', 'Título:', ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('unity', 'Unidade:', ['class' => 'control-label']) !!}
    {!! Form::text('unity', null, ['class' => 'form-control']) !!}
</div>



{!! Form::submit('Criar Nova Etiqueta', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@stop