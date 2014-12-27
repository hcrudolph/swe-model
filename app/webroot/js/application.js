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

function dateAddFormAddSubmitEvent(webroot, courseId) {
    var dateAddForm = '#dateAddForm';
    $(dateAddForm).submit(function(event) {
        $.post(webroot+'Dates/add/'+courseId, $(dateAddForm).serialize(), function(json) {
            if(json.success == true) {
                notificateUser(json.message, 'success');
                //$.get('<?php echo $this->webroot?>Courses/indexElement/'+courseId, function(view) {
                //$('#courseIndexEntry'+courseId).replaceWith(view);
                //});
                $('.modal').modal('hide');
            } else {
                notificateUser(json.message);

                //delete old errors
                $(dateAddForm).children().each(function() {
                    $(this).children().each(function() {
                        $(this).children('div').each(function() {
                            $(this).addClass('panel-default').removeClass('panel-danger has-error');
                            $(this).children('.panel-footer').remove();
                        });
                    });
                });

                for(var controller in json.errors) {
                    for(var key in json.errors[controller]) {
                        if(json.errors[controller].hasOwnProperty(key)) {
                            notificateUser(json.errors[controller][key]);
                            var ele = $(dateAddForm+' > .'+controller+' > div > .'+key);
                            ele.addClass('panel-danger has-error');
                            ele.append('<div class="panel-footer">'+json.errors[controller][key]+'</div>');
                        }
                    }
                }
            }
        }, 'json');
        event.preventDefault();
    });
}


function dateAdd(link, courseId) {
    $.get(link+courseId, function(html) {
        $('body').append(html);
        $('body > .modal').modal('show');
    });
}

function dateEdit(link, dateId) {
    alert('Bearbeiten: '+dateId);
}

function dateDelete(link, dateId) {
    var del = confirm("Date #" + dateId + " löschen?");
    if (del == true) {
        $.post(link + dateId, function (json) {
            if (json.success == true) {
                notificateUser(json.message, 'success');
                //Alle user benachrichtigt?
            } else {
                notificateUser(json.message, json.error);
            }
        }, 'json');
    }
}

function dateSignUpUser(dateId, link) {
    $.post(link+dateId,function(json) {
        if(json.success == true) {
            notificateUser(json.message, 'success');
            //Toggle Buttons
        } else {
            notificateUser(json.message, json.error);
        }
    }, 'json');
}

function dateSignOffUser(dateId, link) {
    $.post(link+dateId,function(json) {
        if(json.success == true) {
            notificateUser(json.message, 'success');
            //Toggle Buttons
        } else {
            notificateUser(json.message, json.error);
        }
    }, 'json');
}