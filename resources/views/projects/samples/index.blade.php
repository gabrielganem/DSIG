@extends('layouts.master')

@section('content')

<h1>{{ $projects->title }}</h1>
<br />

@foreach($samples as $sample)
<div>
    <h3>
      <a href="{{ route('sample.exibeAmostra', array($sample->id, $projects->id)) }}">{{$sample->date}}</a>
    </h3>
    <p>
      Latitude: {{$sample->lat}}
    </p>
    <p>
      Longitude: {{$sample->lng}}
    </p>
  </div>
@endforeach

<a href="{{ route('projects.index') }}" class="btn btn-info">Voltar para Projetos</a>
<a href="{{ route('projects.edit', $projects->id) }}" class="btn btn-primary">Editar Projeto</a>

<div class="col-md-6 text-right">
        {!! Form::open([
            'method' => 'DELETE',
            'route' => ['projects.destroy', $projects->id]
        ]) !!}
            {!! Form::submit('Apagar este Projeto?', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </div>

 <a href="{{ route('sample.novaAmostra', $projects->id) }}" class="btn btn-primary">Adicionar Amostra</a>

@stop
