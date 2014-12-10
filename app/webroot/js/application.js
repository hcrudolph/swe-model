$(document).ready(function() {
    $(window).load(function() {
        //run code after everything is loaded
    });
});


//type: error, success, warning
function notificateUser(message, type)
{
    if (typeof type === "undefined") {
        type='error';
    }
    var n = noty({
        text: message,
        layout: 'topRight',
        theme: 'defaultTheme',
        type: type,
        timeout: 5000
    });
}