navigator.geolocation.getCurrentPosition(function(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;

    $.post('geolocation', {'latitude': latitude, 'longitude': longitude});
});

$('.sport form').on('submit', function (e) {
    e.preventDefault();

    var command = $('[name=command]').val();

    $.post('list_of_losers', {'command': command}).done(function( losers ) {
        console.log(losers);
        var html = '';
        losers.forEach(function (loser) {
            html += "<li>" + loser + "</li>";
        });

        $('#loser_commands').html(html);
    });
});