$(function () {
    $('.rating_2').rating({
        fx: 'float',
        image: 'images/starsss.png',
        width: '1px',
        loader: 'images/ajax-loader.gif',
        url: 'site/index',
        callback: function (responce) {
            this.vote_success.fadeOut(2000);
            this._data.val = responce[0];
            this._data.votes = responce[1];
            this.render();
        }
    });

    $('#button_style').bind('click', function () {
        console.log('+++');
        $.ajax({
            url: '/index-add',
            data: {date: 'all'},
            type: 'POST',
            datatype: 'json',
            success: function (res) {

                goWriteMenu(JSON.parse(res));
            },
            error: function () {
                alert('Error!');
            }
        });

    });

    function goWriteMenu(data) {
        $('.left div').remove();
        $('.right div').remove();
        var i = 0;
        for (i; i < data.length; i++) {

            if (i < data.length / 2) {
                $('.left').append('<div class = \"container_prise\">' +
                    '<div class=\"container_menu_el\">' +
                    '<div class=\"name_eat\">' + data[i].name + '</div>' +
                    '<div class=\"med_line\"></div>' +
                    '<div class=\"cost_eat\">$' + data[i].cost + '</div>' +
                    '</div>' +
                    '<div class=\"info_eat\">' + data[i].info + '</div>' +
                    '</div>');
            } else {
                $('.right').append('<div class = \"container_prise\">' +
                    '<div class=\"container_menu_el\">' +
                    '<div class=\"name_eat\">' + data[i].name + '</div>' +
                    '<div class=\"med_line\"></div>' +
                    '<div class=\"cost_eat\">$' + data[i].cost + '</div>' +
                    '</div>' +
                    '<div class=\"info_eat\">' + data[i].info + '</div>' +
                    '</div>');
            }

        }
        $("#button_style").css("display", "none");

    }
})
