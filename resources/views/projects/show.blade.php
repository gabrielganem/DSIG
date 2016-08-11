@extends('layouts.master')

@section('content')

<h1>{{ $projects->title }}</h1>
<br />
<h4>Descrição</h4>
<p class="lead">{{ $projects->description }}</p>
<h4>Instituição</h4>
<p class="lead">{{ $projects->institute }}</p>
<h4>Departamento</h4>
<p class="lead">{{ $projects->department }}</p>
<hr>

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

 <a href="{{ route('project.amostras', $projects->id) }}" class="btn btn-primary">Exibe Amostras</a>

@stop
