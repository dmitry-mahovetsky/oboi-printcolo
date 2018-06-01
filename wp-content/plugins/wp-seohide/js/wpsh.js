function sh_unhide(data) {
    var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
    var o1, o2, o3, h1, h2, h3, h4, bits, i = 0, enc = '';
    do {
        h1 = b64.indexOf(data.charAt(i++));
        h2 = b64.indexOf(data.charAt(i++));
        h3 = b64.indexOf(data.charAt(i++));
        h4 = b64.indexOf(data.charAt(i++));
        bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;
        o1 = bits >> 16 & 0xff;
        o2 = bits >> 8 & 0xff;
        o3 = bits & 0xff;
        if (h3 == 64)      enc += String.fromCharCode(o1);
        else if (h4 == 64) enc += String.fromCharCode(o1, o2);
        else               enc += String.fromCharCode(o1, o2, o3);
    } while (i < data.length);
    return enc;
}

var $ = jQuery.noConflict();
$(document).ready(function () {
    $('[data-sh]').live('click', function (e) {
        e.preventDefault();
        var attr = $(this).attr('target');
        if (attr == '_blank') {
            window.open(sh_unhide($(this).attr('data-sh')));
        } else {
            document.location.href =  sh_unhide($(this).attr('data-sh'));
        }
    });

    /* Decode url for event when right mouse button press */
    $('body').on( 'mousedown', '[data-sh]', function (e) {
        var data = $(this).attr('data-sh');
        $(this).attr('href', sh_unhide(data));
    });

});