@extends('layouts.master')

@section('content')

<h1>Instituições</h1>
<p class="lead">Estes são as instituições cadastradas até o momento
  <br /><a href="{{ route('institutes.create')}}">Criar uma Nova?</a></p>
<hr>


</article>
@foreach($institutes as $institute)
    <h3>{{ $institute->abreviature }} - {{ $institute->name }}</h3>
    <hr>
@endforeach

@stop
