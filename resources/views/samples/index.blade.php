@extends('layouts.master')

@section('content')

<h1>Amostras</h1>


<p class="lead">Estes são as suas amostras <a href="{{ route('samples.store')}}">Adicionar Nova?</a></p>
<hr>

@foreach($samples as $sample)
    <h3>{{ $sample->date }}</h3>

    <p>
        <a href="{{ route('samples.show', $sample->id) }}" class="btn btn-info">Ver Amostra</a>
    </p>
    <hr>
@endforeach

@stop
