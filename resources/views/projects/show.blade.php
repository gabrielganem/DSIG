@extends('layouts.master')

@section('content')

<h1>{{ $projects->title }}</h1>
<br />
<h4>Descrição</h4>
<p class="lead">{{ $projects->description }}</p>
<h4>Instituição</h4>
<p class="lead">{{ $projects->users[0]->institute->name}}</p>
<h4>Participantes</h4>
  @foreach($projects->users as $user)
  <p class="lead">{{ $user->email}} |
    @if($user->pivot->role) Administrador </p>
    @else
      Colaborador </p>
    @endif
@endforeach

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
 <a href="{{ route('sample.novaAmostra', $projects->id) }}" class="btn btn-primary">Nova Amostra</a>
 <a href="{{ route('project.amostras', $projects->id) }}" class="btn btn-primary">Exibe Amostras</a>



@stop
