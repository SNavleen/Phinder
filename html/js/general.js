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
      // sendToServer();
      var geocoder;
      // Get the address and update the loaction field in the search meanu automaticly
      getAddress(geocoder, userLocation, 'location');
    }
  }
}

function mapLocation() {
  var map = new google.maps.Map(document.getElementById("map"), {
    center: userLocation,
    zoom: 16,
  });
  return map;
}

function sendToServer() {
  // here you can reuse the object to send to a server
  console.log("lat: " + userLocation.lat);
  console.log("lon: " + userLocation.lng);
}
window.onload = function() {
  getLocation();
}