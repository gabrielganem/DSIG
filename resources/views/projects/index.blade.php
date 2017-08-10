@extends('layouts.master')

@section('content')

<h1>Meus Projetos</h1>
<p class="lead">Estes são os seus projetos <a href="{{ route('projects.create')}}">Criar um novo?</a></p>
<hr>

</article>
@foreach($projects as $project)
    <h3>{{ $project->title }}</h3>
    <p>
        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-info">Ver Projeto</a>
        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-primary">Editar Projeto</a>
    </p>
    <hr>
@endforeach

@stop
