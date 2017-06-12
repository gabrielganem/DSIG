@extends('layouts.fsamplebeta')

@section('content')
<div class="container-fluid" >
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

  <div class="row" style="height:100%; width: 100%;  position: relative; margin: 0; padding: 0;">

    <div style="height:100%; width: 100%;">
      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" id="googleMap" style="height:100%; width: 100%;">
      </div>
    </div>

    <div class="col-xs-3 col-sm-3 col-md-0 col-lg-0" style="position: absolute; top: 0; z-index: 99; background-color: #FFF; background-color:rgba(255, 255, 255, 0.7); border-radius: 15px; margin: 10px; margin-top: 50px;">
      <div class="table-responsive col-sm-12" >
        <div ><h3>Projetos Relacionados</h3></div>

        <table class="table table-hover table-striped table-condensed" id="myTable">
      </table>

      </div>
    </div>
  </div>


<script src="https://code.highcharts.com/highcharts.js"></script>

<div class="btn-group">
<a href="{{ route('projects.index') }}" class="btn btn-info">Voltar para Projetos</a>
</div>

@endsection
