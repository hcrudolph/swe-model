<?php if(!empty($user) AND $user['role'] > 1) { ?>
    <button type="button" id="userAddOpenButton" class="btn btn-default" onclick="roomAddButtonClick();"><i class="glyphicon glyphicon-plus"></i>Hinzufügen</button>
<?php } ?>
    <table class="table" id="roomEntries">
        <thead>
        <tr>
            <th>Raumname</th>
            <th>Aktionen</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($rooms as $room) {
            echo $this->element('roomIndexElement', array('room' =>$room));
        } ?>
        </tbody>
    </table>


<?php echo $this->Html->scriptStart(array('inline' => true));?>
    $("#roomEntries").on('roomChanged', function(event) {

        $.get('<?php echo $this->webroot?>rooms/indexElement/'+event.roomId, function(view) {
            if($('#roomIndexEntry'+event.roomId).length) {
                $('#roomIndexEntry'+event.roomId).replaceWith(view);
            } else {
                $('#roomEntries tbody').prepend(view);
            }
        });
    });

    function roomDelete(roomId) {
        var del = confirm("Kurs #" + roomId + " löschen?");
        if (del == true) {
            $.post('<?php echo $this->webroot;?>rooms/delete/'+ roomId, function (json) {
                if (json.success == true) {
                    notificateUser(json.message, 'success');
                    $( "#roomIndexEntry"+roomId ).remove();
                } else {
                    notificateUser(json.message, json.error);
                }
            }, 'json');
        }
    }

    function roomEdit(roomId) {
        $.get('<?php echo $this->webroot?>rooms/edit/'+roomId,function(html) {
            $('body').append(html);
            $('body > .modal').modal('show');
        });
    }

    function roomAddButtonClick() {
        $.get('<?php echo $this->webroot?>rooms/add/',function(html) {
            $('body').append(html);
            $('body > .modal').modal('show');
        });
    }

    function roomEditFormAddSubmitEvent(roomId) {
        var editForm = '#roomEditForm'+roomId;
        $(editForm).submit(function(event) {
            $.post('<?php echo $this->webroot;?>rooms/edit/'+roomId, $(editForm).serialize(), function(json) {
                if(json.success == true) {
                    notificateUser(json.message, 'success');
                    $('.modal').modal('hide');
                    $( "#roomEntries" ).trigger({
                        type:"roomChanged",
                        roomId:roomId
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