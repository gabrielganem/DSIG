<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<title>DSIG</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

<!-- Styles -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="{{ URL::asset('js/iThing.css') }}">
{{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}


<style>
#sidebar-wrapper {
    z-index: 1000;
    position: fixed;
    left: 250px;
    width: 0;
    height: 100%;
    margin: 0px;
    margin-left: -250px;
    overflow-y: auto;
    background: #FFF;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

#wrapper.toggled #sidebar-wrapper {
    width: 250px;
}

#page-content-wrapper {
    width: 100%;
    position: absolute;
    padding: 15px;
}

#wrapper.toggled #page-content-wrapper {
    position: absolute;
    margin-right: -250px;
}

/* Sidebar Styles */

.sidebar-nav {
    position: absolute;
    top: 0;
    width: 250px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.sidebar-nav li {
    text-indent: 20px;
    line-height: 25px;
}

.sidebar-nav li a {
    display: block;
    text-decoration: none;
    color: #999999;
}

.sidebar-nav li a:hover {
    text-decoration: none;
    color: #fff;
    background: rgba(255,255,255,0.2);
}

.sidebar-nav li a:active,
.sidebar-nav li a:focus {
    text-decoration: none;
}

.sidebar-nav > .sidebar-brand {
    height: 65px;
    font-size: 18px;
    line-height: 60px;
}

.sidebar-nav > .sidebar-brand a {
    color: #999999;
}

.sidebar-nav > .sidebar-brand a:hover {
    color: #fff;
    background: none;
}

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
<script type="text/javascript" src="{{ URL::asset('js/jQDateRangeSlider-min.js') }}"></script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAM4ZjSrVS2FPwzQ7kpeBBZoVK49tvcMZg"></script>

<script>
  var markers = [];
  var map;
  var latlngbounds;

function initialize() {
  var mapProp = {
    center:new google.maps.LatLng(-10,-40),
    zoom:5,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };

  map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

  latlngbounds = new google.maps.LatLngBounds();



  @foreach($samples as $sample)
    var marker=new google.maps.Marker({
      position:new google.maps.LatLng({{$sample->lat}}, {{$sample->lng}}),
      title: "{{ $sample->date }}"
      });
    marker.setMap(map);
    latlngbounds.extend(marker.position);
    map.fitBounds(latlngbounds);
    markers.push(marker);
  @endforeach


  var markerCluster = new MarkerClusterer(map, markers);
  }
  google.maps.event.addDomListener(window, 'load', initialize);

function limpaMapa(){
  markers.forEach(function(markert){
    markert.setMap(null);
  })
}

function   atualizaMapa(data){
  // limpa marcadores\
    limpaMapa();
    markers = [];
    var marker;
    //alert('tamanho: '+data.length);
    data.forEach(function(sample){
      alert(sample.lat);
       marker=new google.maps.Marker({
        position:new google.maps.LatLng([sample.lat, sample.lng]),
        title: sample.date,
        map: map
        });
    });

//    latlngbounds.extend(marker.position);
//    map.fitBounds(latlngbounds);
//    markers.push(marker);


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

<div id="sidebar-wrapper">
          <ul class="sidebar-nav">
              <li class="sidebar-brand">
                  <a href="#">
                      Filtro Amostras
                  </a>
                  <form action="/fsamples" method="get">
              </li>
              <li>
                  Atributo:
              </li>
              <li>
                <input type="text" name="label" id="label"><br>
              </li>

              <li>
                <input type="submit" value="Submit">
              </li>


            </form>

            <li>
              <button onclick="carregaAjax(this)">Teste 2</button>
            </li>

            <script>
              function carregaAjax(e){
                var palavra = $('#label').val();
                  $.get( '/fsamples', { "label":palavra, "json":"true" } )
                  .done(function(data){

                    atualizaMapa(data);

                  })
                  .error(function(){
                    alert('bugou alguma merda!');
                  });

                  return false;
              }
            </script>
          </ul>
      </div>

<main>

    <div class="container">

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

<!-- Sidebar -->

</body>
</html>
