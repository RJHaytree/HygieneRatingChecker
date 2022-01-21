function process() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(search);
    }
}

function search(position) {
    let url = './functions/Controller.php';
    let action = 'search';
    let long = position.coords.longitude;
    let lat = position.coords.latitude;
    let terms = $('#search-name').val();
    let radius = $('#search-radius').val();

    if (!radius || isNaN(radius)) {
        alert("The radius you have entered is invalid.\nContinuing with default radius of 1 mile");
        radius = 1;
    }

    let data = {action: action, long: long, lat: lat, terms: terms, radius: radius};
    sendRequest(url, data);
}

function sendRequest(url, data) {
    let type = "POST";

    $('.list').empty();

    $.ajax({
        type: type,
        url: url,
        data: data,
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

$(document).on('click', '#search-name-btn', function(e) {
    e.preventDefault();
    process();
});

$(document).on('click', '#search-radius-btn', function(e) {
    e.preventDefault();
    process();
});

$('#search-name-form').submit(function(e) {
    e.preventDefault();
    window.history.back();
})

$('#search-radius-form').submit(function(e) {
    e.preventDefault();
    window.history.back();
});