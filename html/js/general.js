// All locations
var userLocation = {
  lat: 43.2557206,
  lng: -79.8711024
};

// Get exact address of a lat and lng
function getAddress(geocoder, location, field) {
  geocoder = new google.maps.Geocoder();
  // Get the exact address and set it to the input filed
  geocoder.geocode({
    'latLng': location
  }, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      if (results[0]) {
        var address =
          results[0].address_components[0].long_name + " " +
          results[0].address_components[1].long_name + " " +
          results[0].address_components[2].long_name;
        document.getElementById(field).value = address;
        // console.log(results[0].address_components);
      }
    }
  });
}


function getLocation() {
  // Get users permission
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);

    // Get the lat and lng
    function showPosition(position) {
      userLocation.lat = position.coords.latitude;
      userLocation.lng = position.coords.longitude;
      var geocoder;
      // Get the address and update the loaction field in the search meanu automaticly
      getAddress(geocoder, userLocation, 'location');
    }
  }
}

window.onload = function() {
  getLocation();
}
