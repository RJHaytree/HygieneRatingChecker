$(document).ready(() => {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(init);
    }

    function init(position) {
        let type = 'POST';
        let action = 'init';
        let url = './functions/Controller.php';
        let long = position.coords.longitude;
        let lat = position.coords.latitude;

        $.ajax({
            type: type,
            url: url,
            data: {action: action, lat: lat, long: long},
            beforeSend: function() {
                $('.spinner-border').show();
            },
            complete: function() {
                $('.spinner-border').hide();
            },
            success: function (response) {
                $('.list').html(response);
            }
        });
    }
});