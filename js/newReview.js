<<<<<<< HEAD
function newLocation() {
  var marker;
  var geocoder;
  // Users location
=======
var marker;

function newLocation() {
  // Users location
  var geocoder = new google.maps.Geocoder();
>>>>>>> 63712c9... added object submission page validation and geoAPI
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: userLocation
  });

  google.maps.event.addListener(map, 'click', function(event) {
    // Place the marker
<<<<<<< HEAD

    marker = placeMarker(marker, event.latLng, map);
    getAddress(geocoder, event.latLng, 'location-field');

  });
}

function placeMarker(marker, location, map) {
=======
    placeMarker(event.latLng, map);

    // Get the exact address and set it to the input filed
    geocoder.geocode({
      'latLng': event.latLng
    }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
          var address =
            results[0].address_components[0].long_name + " " +
            results[0].address_components[1].long_name + " " +
            results[0].address_components[2].long_name;
          document.getElementById('location-field').value = address;
          // console.log(results[0].address_components);
        }
      }
    });
  });
}

function placeMarker(location, map) {
>>>>>>> 63712c9... added object submission page validation and geoAPI
  // Check if the marker has been placed, place it or update it
  if (marker) {
    marker.setPosition(location);
  } else {
    marker = new google.maps.Marker({
      position: location,
      map: map
    });
  }
<<<<<<< HEAD
  return marker;
=======
>>>>>>> 63712c9... added object submission page validation and geoAPI
}