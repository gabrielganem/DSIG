@extends('layouts.sample')

@section('content')

<div class="col-md-12 text-center" id="googleMap" style="height:680px;"></div>
<br />

@foreach ($projects as $project)


<div class="table-responsive col-sm-12">
  <div><h3>{{$project->title}}</h3></div>
  <table class="table table-hover table-striped table-condensed">
  <thead>
    <th>Data</th>
    <th>Latitude</th>
    <th>Longitude</th>
  </thead>
  <tbody>
  @foreach($samples as $sample)
  <tr>
      <td>
        <a href="{{ route('sample.exibeAmostra', array($sample->id, $project->id)) }}">{{$sample->date}}</a>
      </td>
      <td>
        {{$sample->lat}}
      </td>
      <td>
        {{$sample->lng}}
      </td>
    </tr>
  @endforeach

</tbody>
</table>
</div>
  @endforeach
<div class="btn-group">
<a href="{{ route('projects.index') }}" class="btn btn-info">Voltar para Projetos</a>

</div>

@endsection
