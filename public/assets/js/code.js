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

$('.photos [name=photo]').on('change', function  () {
    $(".photos form").submit();
});

$('.tasks_list input[name^="description"], .tasks_list input[name^="checked"]')
    .on('change', function () {
        var id = $(this).parents('.tasks_list__item').data('id');
        var name = /(\w+)\[/g.exec($(this).attr('name'))[1];
        var value = $(this).attr('type') === 'text' ? $(this).val() : $(this).prop('checked');

        $.post('tasks_update', {'id': id, 'name': name, 'value': value});
    }
);

c3.generate({
    size: {
        height: 190,
        width: 250
    },
    data: {
        bindto: '#chart',
        url: '/clothes_post',
        mimeType: 'json',
        type : 'pie'
    }
});