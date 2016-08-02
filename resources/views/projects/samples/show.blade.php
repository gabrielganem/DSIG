@extends('layouts.master')

@section('content')

<h1>{{ $projects->title }}</h1>
<br />

@foreach($projects->samples as $sample)
<div>
    <p>
      {{$sample->date}} || {{$sample->geom}}
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

 <a href="#" class="btn btn-primary">Adicionar Campo</a>

@stop
