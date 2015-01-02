function loadPostsBar(webroot){
    $('#postsBar').load(webroot+'posts/slider');
}

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

                var modalContainer = $('<div class="modal fade">');
                var modalDialog = $('<div class="modal-dialog modal-lg">');
                var modalContent = $('<div class="modal-content alert alert-danger">');
                var modalHeader = $('<div class="modal-header">');
                modalHeader.append('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
                modalHeader.append('<h4 class="modal-title">Mitglieder ohne Email-Adresse</h4>');
                var modalBody = $('<div class="modal-body">');

                var tableContainer = $('<table class="table">');
                var tableHeader = $('<thead>');
                tableHeader.append('<th>Vorname</th>');
                tableHeader.append('<th>Nachname</th>');
                tableHeader.append('<th>Telefonnummer</th>');
                tableHeader.append('<th>PLZ</th>');
                tableHeader.append('<th>Stadt</th>');
                tableHeader.append('<th>Straße</th>');
                tableHeader.append('<th>Hausnummer</th>');
                var tableBody = $('<tbody>');

                for (var userElement in json.nomail) {
                    if (json.nomail.hasOwnProperty(userElement)) {
                        var user = json.nomail[userElement];
                        var entry = $('<tr>');
                        entry.append('<td>'+user['surname']+'</td>');
                        entry.append('<td>'+user['name']+'</td>');
                        entry.append('<td>'+user['phone']+'</td>');
                        entry.append('<td>'+user['adress']['plz']+'</td>');
                        entry.append('<td>'+user['adress']['city']+'</td>');
                        entry.append('<td>'+user['adress']['street']+'</td>');
                        entry.append('<td>'+user['adress']['housenumber']+user['adress']['hnextra']+'</td>');
                        tableBody.append(entry);
                    }
                }

                tableContainer.append(tableHeader);
                tableContainer.append(tableBody);
                modalBody.append(tableContainer);

                var modalFooter = $('<div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button></div>');

                modalContent.append(modalHeader);
                modalContent.append(modalBody);
                modalContent.append(modalFooter);
                modalDialog.append(modalContent);
                modalContainer.append(modalDialog);

                $('body').append(modalContainer);
                $('body > .modal').modal('show');
                $('body > .modal').on('hidden.bs.modal', function (e) {
                    $('.modal').remove();
                });
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