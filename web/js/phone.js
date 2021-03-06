function clearVal(val, limit) {
    var newVal = val.replace(/[^\d]+/g, '');
    if (newVal == '') return false;
    else return newVal.substring(0, limit);
}

function getResString(newVal) {
    var res = '+';
    for (var i = 0; i < newVal.length; i++) {
        if (i == 3) {
            res += " (";
            res += newVal.charAt(i);
        } else if (i == 5) {
            res += ") ";
            res += newVal.charAt(i);
        } else if (i == 8 || i == 10) {
            res += "-";
            res += newVal.charAt(i);
        } else {
            res += newVal.charAt(i);
        }
    }
    return res;
}

function validForm(nam, numb) {

    if (numb == '') return "Заполните поле!";
    if (numb.length != 19) return "Неполный №телефона!";
    return true;
}

function setCookie(name, value, options) {
    options = options || {};

    var expires = options.expires;

    if (typeof expires == "number" && expires) {
        var d = new Date();
        d.setTime(d.getTime() + expires * 1000);
        expires = options.expires = d;
    }
    if (expires && expires.toUTCString) {
        options.expires = expires.toUTCString();
    }

    value = encodeURIComponent(value);

    var updatedCookie = name + "=" + value;

    for (var propName in options) {
        updatedCookie += "; " + propName;
        var propValue = options[propName];
        if (propValue !== true) {
            updatedCookie += "=" + propValue;
        }
    }

    document.cookie = updatedCookie;
}

function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}


$(function () {

    var name, number, infoChek;

    $('.lb-close').bind('click', function (e) {

        $('#contactform-name').val("");
        $('#contactform-phone').val("");
    });

    $('#contactform-phone').keyup(function () {
        var val = $(this).val()
        limit = 12;
        if (val == '') return;

        var newVal = clearVal(val, limit);
        if (!newVal) {
            $(this).val('');
            return;
        }
        var res = getResString(newVal);
        $(this).val(res);
    });

    $('#reservation-phone').keyup(function () {
        var val = $(this).val()
        limit = 12;
        if (val == '') return;

        var newVal = clearVal(val, limit);
        if (!newVal) {
            $(this).val('');
            return;
        }
        var res = getResString(newVal);
        $(this).val(res);
    });
});
