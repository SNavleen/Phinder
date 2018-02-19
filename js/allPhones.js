// What will be displayed when the user selects the location
var iPhone7Plus =
  '<h3 id="ip7p" class="item-title"><a href="phone/pixel2.html">iPhone 7 Plus (Best Buy)</a></h3>' +
  '<div id="bodyContent">' +
  '<p>' +
  'iPhone 7 Plus is a smartphones designed, developed, and marketed by Apple Inc.' +
  '</p>' +
  '</div>'

var nexus5X =
  '<h3 id="n5x" class="item-title"><a href="phone/pixel2.html">Nexus 5 X (Best Buy)</a></h3>' +
  '<div id="bodyContent">' +
  '<p>' +
  'Nexus 5X (codenamed bullhead) is an Android smartphone manufactured by LG Electronics, co-developed with and marketed by Google Inc.' +
  '</p>' +
  '</div>'

var samsungS8 =
  '<h3 id="ss8" class="item-title"><a href="phone/pixel2.html">Samsung S 8 (Best Buy)</a></h3>' +
  '<div id="bodyContent">' +
  '<p>' +
  'The Samsung Galaxy S8 is an Android smartphones produced by Samsung Electronics as part of the Samsung Galaxy S series.' +
  '</p>' +
  '</div>'


// All locations
var userLocation = {
  lat: 43.2557206,
  lng: -79.8711024
};
var iPhone7PlusLocation = {
  lat: 43.2299867,
  lng: -79.9404233
};
var nexus5XLocation = {
  lat: 43.1953076,
  lng: -79.8112889
};
var samsungS8Location = {
  lat: 43.3421969,
  lng: -79.8254334
};

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