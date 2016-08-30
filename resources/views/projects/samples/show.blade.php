@extends('layouts.master')

@section('content')

<h1>Amostra {{ $samples->date }}</h1>
<h3>{{ $projects->title }}</h3>

<p class="lead">Estes são seus campos <a href="{{ route('samples.store')}}">Adicionar Nova?</a></p>
<hr>
    <h3>{{ $samples->geom }}</h3>
    <ul class="list-group">
    @foreach($fields as $field)
      <li class="list-group-item col-sm-4">
        <span class="col-sm-4 strong">{{ $field->label->title}}: </span>
        <span >{{ $field->value }}</span>

    @endforeach
    </ul>
@stop
