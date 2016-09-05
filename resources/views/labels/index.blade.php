@extends('layouts.master')

@section('content')

<h1>Etiquetas</h1>
<p><a href="{{ route('labels.create')}}">Criar uma nova?</a></p>
<hr>

@foreach($labels as $label)
    <p>{{ $label->title }} | {{ $label->unity}}</p>

    <hr>
@endforeach


		 {!! Form::open([
		    'route' => 'labels.store'
		]) !!}

		<div class="form-group">
		    {!! Form::label('title', 'Título:', ['class' => 'control-label']) !!}
		    {!! Form::select('title', $labels, ['class' => 'form-control']) !!}
		</div>

		{!! Form::close() !!}
    <p>
        <a href="{{ route('home') }}" class="btn btn-info">Voltar</a>
    </p>
@stop
