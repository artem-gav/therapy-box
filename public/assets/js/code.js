navigator.geolocation.getCurrentPosition(function(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;

    $.post('geolocation', {'latitude': latitude, 'longitude': longitude});
});