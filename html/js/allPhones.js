var items = new Array();
var map;

function itemHTML(itemObj) {
  var itemId = itemObj["itemId"];
  var name = itemObj["name"];
  var details = itemObj["details"];
  var avgRating = itemObj["avgRating"];
  var url = "phone?name="+name;
  // What will be displayed when the user selects the location
  var itemContent =
    '<h3 id="'+itemId+'" class="item-title">'+
      '<a href="'+url+'">'+name+'</a>'+
    '</h3>'+
    '<div id="bodyContent">'+
      '<p>'+
        'Average Rating: <b>'+avgRating+'</b>'
      '</p>'+
    '</div>';
  return itemContent;
}

function itemLocation(item, cb) {
  var geocoder = new google.maps.Geocoder();

  geocoder.geocode({
    'address': item["address"]
  }, function(results, status) {

    if (status == google.maps.GeocoderStatus.OK) {
      cb(item, itemGeoLocation = {
        lat: results[0].geometry.location.lat(),
        lng: results[0].geometry.location.lng()
      });
    }
  });
}

// Basic map with it being cnetered on user and having 3 different pointers for different locations
function initMap() {
  // Users location
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: userLocation
  });

  itemsJSON.forEach(function(item) {
    itemLocation(item, addMarker);
  });
}

function addMarker(item, itemGeoLocation) {
  // All the items locations
  var itemMarker = new google.maps.Marker({
    position: itemGeoLocation,
    map: map,
    title: ''
  });

  var itemContent = itemHTML(item);
  var itemInfoWindow = new google.maps.InfoWindow({
    content: itemContent
  });

  // Add the marker
  itemMarker.addListener('click', function() {
    itemInfoWindow.open(map, itemMarker);
  });
}
