// Basic map with it being cnetered on user and having 3 different pointers for different locations
function initMap() {
  // Users location
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: userLocation
  });

  // All the items information
  var iPhone7PlusInfoWindow = new google.maps.InfoWindow({
    content: iPhone7Plus
  });
  var nexus5XInfoWindow = new google.maps.InfoWindow({
    content: nexus5X
  });
  var samsungS8InfoWindow = new google.maps.InfoWindow({
    content: samsungS8
  });

  // All the items locations
  var iPhone7PlusMarker = new google.maps.Marker({
    position: iPhone7PlusLocation,
    map: map,
    title: 'iPhone7Plus'
  });
  var nexus5XMarker = new google.maps.Marker({
    position: nexus5XLocation,
    map: map,
    title: 'Nexus5X'
  });
  var samsungS8Marker = new google.maps.Marker({
    position: samsungS8Location,
    map: map,
    title: 'SamsungS8'
  });

  // Add the marker
  iPhone7PlusMarker.addListener('click', function() {
    iPhone7PlusInfoWindow.open(map, iPhone7PlusMarker);
  });
  nexus5XMarker.addListener('click', function() {
    nexus5XInfoWindow.open(map, nexus5XMarker);
  });
  samsungS8Marker.addListener('click', function() {
    samsungS8InfoWindow.open(map, samsungS8Marker);
  });
}