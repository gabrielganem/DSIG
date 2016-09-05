@extends('layouts.master')

@section('content')

<h1>Amostra {{ $samples->date }}</h1>
<h3>{{ $projects->title }}</h3>
<div class="col-sm-8">
<a href="{{ route('samples.store')}}">Adicionar Nova Amostra?</a></p>
<hr>
    <ul class="list-group">
    @foreach($samples->fields as $field)
      <li class="list-group-item col-sm-6">
        <span >{{ $field->label->title}}: </span>
        <span>{{ $field->value }}</span>
      </li>
    @endforeach
    </ul>
  </div>

  <div  class="col-sm-8">
 <a href="{{ route('project.amostras', $projects->id) }}" class="btn btn-primary">Voltar para Amostras</a>
 </div>
@stop
