<?php if(!empty($user) AND $user['role'] > 0) { ?>
    <button type="button" id="userAddOpenButton" class="btn btn-default" onclick="tariffAddButtonClick();"><i class="glyphicon glyphicon-plus"></i>Hinzufügen</button>
<?php } ?>


<table id="tariffEntries">
    <thead>
    <tr>
        <th>Name</th>
        <th>Aktionen</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach($tariffs as $tariff) {
    echo $this->element('tariffIndexElement', array('tariff' =>$tariff));
    } ?>
    </tbody>
</table>


<?php echo $this->Html->scriptStart(array('inline' => true));?>
    $("#tariffEntries").on('tariffChanged', function(event) {
        $.get('<?php echo $this->webroot?>tariffs/indexElement/'+event.tariffId, function(view) {
            if($('#tariffIndexEntry'+event.tariffId).length) {
                $('#tariffIndexEntry'+event.tariffId).replaceWith(view);
            } else {
                $('#tariffEntries').prepend(view);
            }
        });
    });

    function tariffDelete(tariffId) {
        var del = confirm("Kurs #" + tariffId + " löschen?");
        if (del == true) {
            $.post('<?php echo $this->webroot;?>tariffs/delete/'+ tariffId, function (json) {
                if (json.success == true) {
                    notificateUser(json.message, 'success');
                $( "#tariffIndexEntry"+tariffId ).remove();
                } else {
                    notificateUser(json.message, json.error);
                }
            }, 'json');
        }
    }

    function tariffEdit(tariffId) {
        $.get('<?php echo $this->webroot?>tariffs/edit/'+tariffId,function(html) {
            $('body').append(html);
            $('body > .modal').modal('show');
        });
    }

    function tariffAddButtonClick() {
        $.get('<?php echo $this->webroot?>tariffs/add/',function(html) {
            $('body').append(html);
            $('body > .modal').modal('show');
        });
    }

    function tariffEditFormAddSubmitEvent(tariffId) {
        var editForm = '#tariffEditForm';
        $(editForm).submit(function(event) {
            $.post('<?php echo $this->webroot;?>tariffs/edit/'+tariffId, $(editForm).serialize(), function(json) {
                if(json.success == true) {
                    notificateUser(json.message, 'success');
                    $('.modal').modal('hide');
                    $( "#tariffEntries" ).trigger({
                        type:"tariffChanged",
                        tariffId:tariffId
                    });
                } else {
                    notificateUser(json.message);

                    //delete old errors
                    $(editForm).children().each(function() {
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
                                var ele = $(editForm+' > .'+controller+' > div > .'+key);
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
<?php echo $this->Html->scriptEnd();?>