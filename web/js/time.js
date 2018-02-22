function clear(val, limit) {
    var newVal = val.replace(/[^\d]+/g, '');
    if (newVal == '') return false;
    else return newVal.substring(0, limit);
}

function newString(newVal) {
    var res = '';
    for (var i = 0; i < newVal.length; i++) {
        if (i == 2) {
            res += ":";
            res += newVal.charAt(i);
        } else {
            res += newVal.charAt(i);
        }
    }
    return res;
}

$(function () {
    $('#reservation-time').keyup(function () {

        limit = 5;
        var val = $(this).val()

        if (val == '') return '--:--';

        var newVal = clear(val, limit);
        if (!newVal) {
            $(this).val('');
            return;
        }
        var res = newString(newVal);

        $(this).val(res);
    });

});