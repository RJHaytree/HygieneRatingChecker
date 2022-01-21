function getLocation(callback) {
    if (navigator.geolocation) {
        var location = navigator.geolocation.getCurrentPosition(function(position) {
            user_position = {};
            user_position.lat = position.coords.latitude;
            user_position.lng = position.coords.longitude;
            callback(user_position);
        });
    }
}

function initMap(id, name) {
    getLocation(function(location) {
        let lat = location.lat;
        let lng = location.lng;

        let mapOptions = {
            zoom: 15,
            center: new google.maps.LatLng(lat, lng)
        };
        let map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        let infoWindow = new google.maps.InfoWindow();
        let userInfoWindow = new google.maps.InfoWindow();
        let placeService = new google.maps.places.PlacesService(map);

        placeService.getDetails({
            placeId: id
        }, function(result, status) {
            if (status != google.maps.places.PlacesServiceStatus.OK) {
                alert(status);
                return;
            }
            let user_marker = new google.maps.Marker({
                map: map,
                position: { lat: lat, lng: lng},
                animation: google.maps.Animation.DROP
            });

            let marker = new google.maps.Marker({
                map: map,
                position: result.geometry.location,
                animation: google.maps.Animation.DROP
            });
            let address = result.adr_address;
            let new_address = address.split("</span>, ");

            userInfoWindow.setContent("<b>You</b>");
            userInfoWindow.open(map, user_marker);

            infoWindow.setContent("<b>" + name + "</b>" + "<hr>" + new_address[0] + "<br>" + new_address[1] + "<br>" + new_address[2]);
            infoWindow.open(map, marker);
        });
    });
}


$(document).on('show.bs.modal', '#mapModal', function (event) {
    var triggerElement = $(event.relatedTarget); 
    let name = triggerElement.data("name");
    let id = triggerElement.data("id");
    $('.modal-title').text(name);

    initMap(id, name);
});