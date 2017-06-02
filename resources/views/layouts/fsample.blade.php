<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<title>DSIG</title>

<!-- -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<style type="text/css">
${demo.css}
</style>
<script type="text/javascript">

$(function()
{
    Highcharts.setOptions(
      {
        chart: {
            backgroundColor: {
                linearGradient: [0, 0, 500, 500],
                stops: [
                    [0, 'rgb(255, 255, 255)'],
                    [1, 'rgb(240, 240, 255)']
                    ]
            },
            borderWidth: 4,
            plotBackgroundColor: 'rgba(255, 255, 255, .9)',
            plotShadow: true,
            plotBorderWidth: 1
        }
    });

    var chart1 = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
        },

        xAxis: {
            type: 'datetime'
        },

        series: [{
            data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
            pointStart: Date.UTC(2010, 0, 1),
            pointInterval: 3600 * 1000 // one hour
        }]
    });


    var chart2 = new Highcharts.Chart({
        chart: {
            renderTo: 'container2',
            type: 'column'
        },

        xAxis: {
            type: 'datetime'
        },

        series: [{
            data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
            pointStart: Date.UTC(2010, 0, 1),
            pointInterval: 3600 * 1000 // one hour
        }]
    });
});
</script>
<!-- -->


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

<!-- Styles -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="{{ URL::asset('js/iThing.css') }}">
{{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}


<style>
/* Sidebar Styles */
@media(min-width:768px) {
    #wrapper {
        padding-left: 250px;
    }
    #wrapper.toggled {
        padding-left: 0;
    }
    #sidebar-wrapper {
        width: 250px;
    }
    #wrapper.toggled #sidebar-wrapper {
        width: 0;
    }
    #page-content-wrapper {
        padding: 20px;
        position: relative;
    }
    #wrapper.toggled #page-content-wrapper {
        position: relative;
        margin-right: 0;
    }
}
</style>

<script>
    var assetBaseUrl = "{{ asset('') }}";
</script>
<script type="text/javascript" src="{{ URL::asset('js/markerclusterer.js') }}"></script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAM4ZjSrVS2FPwzQ7kpeBBZoVK49tvcMZg"></script>

<script>
  var markers = [];
  var map;
  var latlngbounds;
  google.maps.event.addDomListener(window, 'load', initialize);
    function clearTable()
    {
      var table = document.getElementById("myTable");
      table.innerHTML = "";
    }

    function addRow(data)
    {
      clearTable();
      var table = document.getElementById("myTable");
      data.forEach(function(projetos) {
          var row = table.insertRow(-1);
          var cell1 = row.insertCell(0);
          cell1.innerHTML = '<a href="projects/'+ projetos.id +'">' + projetos.title + '</a>';
      });
    }

  function initialize()
  {
      var mapProp = {
        center:new google.maps.LatLng(-10,-40),
        zoom:5,
        mapTypeId:google.maps.MapTypeId.ROADMAP
      };
      map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
      latlngbounds = new google.maps.LatLngBounds();
      plotaMapa(map);
  }

function plotaMapa()
{
  @foreach($samples as $sample)
      var marker=new google.maps.Marker({
        position:new google.maps.LatLng({{$sample->lat}}, {{$sample->lng}}),
        title: "{{ $sample->date }}"
        });

        var infowindow = new google.maps.InfoWindow(), marker;
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function()
            {
                    var str = "coco";
                    infowindow.setContent(str);
                    infowindow.open(map, marker);
            }
        })(marker))
      marker.setMap(map);
      latlngbounds.extend(marker.position);
      markers.push(marker);

      google.maps.event.addListener(map, 'click', function() {
  infowindow.close();
});
    @endforeach
    var markerCluster = new MarkerClusterer(map, markers);

    console.log(markers);
    map.fitBounds(latlngbounds);
    //var markerCluster = new MarkerClusterer(map, markers);
}
function setMapOnAll(map)
{
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

function clearMarkers()
{
  setMapOnAll(null);
  clearClusterer();
}

function deleteMarkers()
{
  clearMarkers();
  markers = [];
}

function atualizaTabela(data)
{
  addRow(data);
}

function atualizaMapa(data)
{
  // limpa marcadores\
  deleteMarkers();
  markerCluster.setMap(null);

    var marker;
    //alert('tamanho: '+data.length);
    //clearTable();
    if(data["amostras"])
    {
    var infowindow = new google.maps.InfoWindow({
      content: ''
    });
    data["amostras"].forEach(function(sample){
          marker=new google.maps.Marker({
          position:new google.maps.LatLng(sample.lat, sample.lng),
          title: sample.date,
          map: map,
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function()
            {
              var str = "";
              data["projetos"].forEach(function(projeto)
                {
                  if (projeto.id == sample.project_id)
                  {
                    //var str = "";
                    str +=  projeto.title + "<br />";
                    data["campos"].forEach(function(campo){
                      if(campo.sample_id == sample.id)
                      {
                        data["etiquetas"].forEach(function(etiqueta)
                        {
                          if(etiqueta.id == campo.label_id)
                          {
                            str += etiqueta.title + " : " + campo.value + "<br />";
                          }
                        })
                      }
                    })
                    infowindow.setContent(str);
                  }
                })
                infowindow.open(map, marker);
            }
        })(marker))
        //addRow(sample);
        marker.setMap(map);
        latlngbounds.extend(marker.position);
        markers.push(marker);
    });
  }
    var markerCluster = new MarkerClusterer(map, markers);
    console.log(markers);
    map.fitBounds(latlngbounds);
//    var markerCluster = new MarkerClusterer(map, markers);
}

</script>

<style>
    body {
        font-family: 'Lato';
    }
    .fa-btn {
        margin-right: 6px;
    }
</style>
</head>
<body>

<nav class="navbar navbar-default navbar-static-top">
  <div class="container">
      <div class="navbar-header">

          <!-- Collapsed Hamburger -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
              <span class="sr-only">Toggle Navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>

          <!-- Branding Image -->
          <a class="navbar-brand" href="{{ url('/home') }}">
              DSIG
          </a>
      </div>

      <div class="collapse navbar-collapse" id="app-navbar-collapse">
          <!-- Left Side Of Navbar -->

          <!-- Right Side Of Navbar -->
          <ul class="nav navbar-nav navbar-right">
              <!-- Authentication Links -->
              @if (Auth::guest())
                  <li><a href="{{ url('/login') }}">Entrar</a></li>
                  <li><a href="{{ url('/register') }}">Cadastrar</a></li>
              @else
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          {{ Auth::user()->name }} <span class="caret"></span>
                      </a>

                      <ul class="dropdown-menu" role="menu">
                          <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Sair</a></li>
                      </ul>
                  </li>
              @endif
          </ul>
      </div>
  </div>

</nav>

  <script>
  function ObjectLength_Modern( object )
  {
    return Object.keys(object).length;
  }
    function carregaAjax(e)
    {
      document.getElementById("jserror").innerHTML = "Carregando";

      var termoDeBusca = $('#label').val();
        $.get( '/fsamples', { "label":termoDeBusca, "json":"true" } )
        .done(function(data)
        {
                //var tamanho = data.amostras.length;
                if (data.amostras)
                {
                  var tamanho = data.amostras.length;
                  if(tamanho == 1)
                  {
                    document.getElementById("jserror").innerHTML = "Encontrado "+tamanho+" elemento";
                  }
                  else
                    {
                      document.getElementById("jserror").innerHTML = "Encontrados "+tamanho+" elementos";
                    }
                  atualizaMapa(data);
                  atualizaTabela(data["projetos"]);
                  }
                else
                  {
                    document.getElementById("jserror").innerHTML = "0 Objeto Encontrado";
                  }
              })
              .error(function(){
                  alert("banana");
                  document.getElementById("jserror").innerHTML = "Nenhum Objeto Encontrado";
              });
              return false;
          }
        </script>

        <script>
        function showResult(e)
        {
          var palavra = $('#label').val();
            $.get( '/flabels', { "label":palavra, "json":"true" } )
            .done(function(data)
            {
                    //var tamanho = data.amostras.length;
                    if (data)
                    {
                      console.log(data);
                      var tamanho = data.length;
                      if(tamanho == 1)
                      {
                        document.getElementById("jserror").innerHTML = "Encontrado "+tamanho+" elemento banana";
                      }
                      else
                        {
                          data.forEach(function(label)
                          {
                            document.getElementById("livesearch").innerHTML=label.title;
                            document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                          });
                      //atualizaMapa(data);
                      //atualizaTabela(data["projetos"]);
                      }
                    }
                    else
                      {
                        document.getElementById("livesearch").innerHTML="";
                        document.getElementById("livesearch").style.border="0px";
                        return;
                      }
                  })
                  .error(function()
                  {
                      alert("banana");
                      document.getElementById("jserror").innerHTML = "Nenhum Objeto Encontrado banana ss";
                  });
                  return false;
        }
        </script>

<main style="width: 100%; height: 100%;">

    <div class="container" style="width: 100%; height: 100%;">

    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            {{ Session::get('flash_message') }}
        </div>
    @endif
        @yield('content')
    </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

</body>
</html>
