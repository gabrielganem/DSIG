@extends('layouts.fsample')

@section('content')
<div class="container-fluid">
  <form class="form-horizontal" action="/fsamples" method="get" autocomplete="off">
    <div class="form-group">
        <input placeholder="Pesquise aqui por um parâmetro" oninput="carregaAjax(this)" class="form-control" type="text" name="label" id="label">
        <!--<button type="submit" class="btn btn-default" onclick="carregaAjax(this)">Teste 2</button>-->
    </div>
  </form>
</div>
<p id="jserror">
  Comece a pesquisar agora!
</p>
<div  class="col-md-12 text-center" id="googleMap" style="height:680px;"></div>
<br />

<!--

@foreach ($samples as $sample)

<div class="table-responsive col-sm-12">
  <div><h3>{{$sample->date}}</h3></div>

  <table id ="myTable" class="table table-hover table-striped table-condensed">
  <thead>
    <th>Data</th>
    <th>Latitude</th>
    <th>Longitude</th>
  </thead>

  <tbody>

  </tbody>

</table>

</div>

@endforeach

-->

<div class="btn-group">
<a href="{{ route('projects.index') }}" class="btn btn-info">Voltar para Projetos</a>

</div>

@endsection
