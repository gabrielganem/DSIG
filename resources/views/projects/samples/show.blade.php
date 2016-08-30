@extends('layouts.master')

@section('content')

<h1>Amostra {{ $samples->date }}</h1>
<h3>{{ $projects->title }}</h3>

<p class="lead">Estes são as suas amostras <a href="{{ route('samples.store')}}">Adicionar Nova?</a></p>
<hr>

    <h3>{{ $samples->geom }}</h3>

@stop
