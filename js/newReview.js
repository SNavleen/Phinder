function newLocation() {
  var marker;
  var geocoder;
  // Users location
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: userLocation
  });

  google.maps.event.addListener(map, 'click', function(event) {
    // Place the marker

    marker = placeMarker(marker, event.latLng, map);
    getAddress(geocoder, event.latLng, 'location-field');

  });
}

function placeMarker(marker, location, map) {
  // Check if the marker has been placed, place it or update it
  if (marker) {
    marker.setPosition(location);
  } else {
    marker = new google.maps.Marker({
      position: location,
      map: map
    });
  }
  return marker;
}