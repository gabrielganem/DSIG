@extends('layouts.sample')

@section('content')

<h1>
    {{ $projects->title }}
</h1>
<br>

<div class="col-md-12 text-center" id="googleMap" style="height:680px;">
</div>

<div class="table-responsive col-sm-12">
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
        <a href="{{ route('sample.exibeAmostra', array($sample->id, $projects->id)) }}">{{$sample->date}}</a>
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


  <form id="select_label" action="filterMarkers(this.value);">
  @foreach($projects->labels as $label)
      <input type="checkbox" name="{{$label->title}}" value="{{$label->id}}">{{$label->title}}><br>
  @endforeach
  </form>

</div>


<div class="btn-group">
  <a href="{{ route('projects.index') }}" class="btn btn-info">Voltasr para Projetos</a>
  <a href="{{ route('projects.edit', $projects->id) }}" class="btn btn-primary">Edssitar Projeto</a>
  <a href="{{ route('sample.novaAmostra', $projects->id) }}" class="btn btn-primary">Adicionar Amostra</a>
</div>

@endsection
