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
                $('.modal').modal('hide');
                $( "#courseEntries" ).trigger({
                    type:"courseChanged",
                    courseId:courseId
                });
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
    $.get(link+dateId, function(html) {
        $('body').append(html);
        $('body > .modal').modal('show');
    });
}
function dateEditFormAddSubmitEvent(webroot, dateId, courseId) {
    var dateEditForm = '#dateEditForm';
    $(dateEditForm).submit(function(event) {
        $.post(webroot+'Dates/edit/'+dateId, $(dateEditForm).serialize(), function(json) {
            if(json.success == true) {
                notificateUser(json.message, 'success');
                $('.modal').modal('hide');
                $( "#courseEntries" ).trigger({
                    type:"courseChanged",
                    courseId:courseId
                });
            } else {
                notificateUser(json.message);

                //delete old errors
                $(dateEditForm).children().each(function() {
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
                            var ele = $(dateEditForm+' > .'+controller+' > div > .'+key);
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

function dateDelete(link, dateId, courseId) {
    var del = confirm("Date #" + dateId + " löschen?");
    if (del == true) {
        $.post(link + dateId,{courseId:courseId}, function (json) {
            if (json.success == true) {
                notificateUser(json.message, 'success');
                $( "#courseEntries" ).trigger({
                    type:"courseChanged",
                    courseId:json.courseId
                });
                //Anzeige der User, die keine User bekommen haben.
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
            $( "#courseEntries" ).trigger({
                type:"courseChanged",
                courseId:json.courseId
            });
        } else {
            notificateUser(json.message, json.error);
        }
    }, 'json');
}

function dateSignOffUser(dateId, link) {
    $.post(link+dateId,function(json) {
        if(json.success == true) {
            notificateUser(json.message, 'success');
            $( "#courseEntries" ).trigger({
                type:"courseChanged",
                courseId:json.courseId
            });
        } else {
            notificateUser(json.message, json.error);
        }
    }, 'json');
}

function userEdit(link, dateId) {
    $.get(link+dateId, function(html) {
        $('body').append(html);
        $('body > .modal').modal('show');
    });
}