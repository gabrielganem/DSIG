@extends('layouts.fsample')

@section('content')

<div class="col-md-12 text-center" id="googleMap" style="height:680px;"></div>
<br />




@foreach ($samples as $sample)

<div class="table-responsive col-sm-12">
  <div><h3>{{$sample->date}}</h3></div>

  <table class="table table-hover table-striped table-condensed">
  <thead>
    <th>Data</th>
    <th>Latitude</th>
    <th>Longitude</th>
  </thead>

</table>

</div>


@endforeach



<div class="btn-group">
<a href="{{ route('projects.index') }}" class="btn btn-info">Voltar para Projetos</a>

</div>

@endsection
