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

<div class="container-fluid">
  <div class="row">
    <div class="col-xs-3 col-sm-4 col-md-0 col-lg-0">
      <div class="table-responsive col-sm-12">
        <div><h3>Projetos Relacionados</h3></div>

        <table class="table table-hover table-striped table-condensed" id="myTable">
      </table>

      </div>
    </div>

    <div class="span10">
      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" id="googleMap" style="height:680px;"></div>
      <br />
    </div>
  </div>
</div>


___


<script src="https://code.highcharts.com/highcharts.js"></script>


<div id="container" style="height: 400px; width: 510px"></div>
  <div id="container2" style="height: 400px; width: 510px"></div>
</body>
</html>



<div class="btn-group">
<a href="{{ route('projects.index') }}" class="btn btn-info">Voltar para Projetos</a>

</div>

@endsection
