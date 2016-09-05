<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>DSIG</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<script>
    var assetBaseUrl = "{{ asset('') }}";
</script>
<script type="text/javascript" src="{{ URL::asset('js/markerclusterer.js') }}"></script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAM4ZjSrVS2FPwzQ7kpeBBZoVK49tvcMZg"></script>

<script>

function initialize() {
  var mapProp = {
    center:new google.maps.LatLng(-10,-40),
    zoom:5,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };

  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

  var latlngbounds = new google.maps.LatLngBounds();

  var markers = [];

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

</script>

</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="{{ route('home') }}">DSIG</a>
    </div>
    <div class="nav navbar-nav navbar-right">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('projects.index') }}">Projetos</a></li>
    </div>
  </div>
</nav>

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


</body>
</html>
