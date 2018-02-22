$(function () {
    var teg,
        str;
    $("a[class='clvis']").bind('click', function () {
        $("#content_events").css("display", "none");
        $("#concreat_events").css("display", "block");
        $("#back").css("display", "block");
    });


    $("#back").bind('click', function () {
        $("#content_events").css("display", "block");
        $("#concreat_events").css("display", "none");
        $("#back").css("display", "none");
    });


});
