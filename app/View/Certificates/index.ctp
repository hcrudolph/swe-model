<?php if(!empty($user) AND $user['role'] > 0) { ?>
    <button type="button" id="userAddOpenButton" class="btn btn-default" onclick="certificateAddButtonClick();"><i class="glyphicon glyphicon-plus"></i>Hinzufügen</button>
<?php } ?>

<table id="certificateEntries" class="table">
    <thead>
    <th>Name</th>
    <th>Aktionen</th>
    </thead>
    <tbody>
    <?php foreach($certificates as $certificate) {
        echo $this->element('certificateIndexElement', array('certificate' =>$certificate));
    } ?>
    </tbody>
</table>


<?php echo $this->Html->scriptStart(array('inline' => true));?>
    $("#certificateEntries").on('certificateChanged', function(event) {

        $.get('<?php echo $this->webroot?>certificates/indexElement/'+event.certificateId, function(view) {
            if($('#certificateIndexEntry'+event.certificateId).length) {
                $('#certificateIndexEntry'+event.certificateId).replaceWith(view);
            } else {
                $('#certificateEntries tbody').prepend(view);
            }
        });
    });

    function certificateDelete(certificateId) {
        var del = confirm("Zertifikat #" + certificateId + " löschen?");
        if (del == true) {
            $.post('<?php echo $this->webroot;?>certificates/delete/'+ certificateId, function (json) {
                if (json.success == true) {
                    notificateUser(json.message, 'success');
                    $( "#certificateIndexEntry"+certificateId ).remove();
                } else {
                    notificateUser(json.message, json.error);
                }
            }, 'json');
        }
    }

    function certificateEdit(certificateId) {
        $.get('<?php echo $this->webroot?>certificates/edit/'+certificateId,function(html) {
            $('body').append(html);
            $('body > .modal').modal('show');
        });
    }

    function certificateAddButtonClick() {
        $.get('<?php echo $this->webroot?>certificates/add/',function(html) {
            $('body').append(html);
            $('body > .modal').modal('show');
        });
    }

    function certificateEditFormAddSubmitEvent(certificateId) {
        var editForm = '#certificateEditForm';
        $(editForm).submit(function(event) {
            $.post('<?php echo $this->webroot;?>certificates/edit/'+certificateId, $(editForm).serialize(), function(json) {
                if(json.success == true) {
                    notificateUser(json.message, 'success');
                    $('.modal').modal('hide');
                    $( "#certificateEntries" ).trigger({
                        type:"certificateChanged",
                        certificateId:certificateId
                    });
                } else {
                    notificateUser(json.message);

                    //delete old errors
                    $(editForm).find('.Certificate').each(function(){
                        $(this).find('.panel').each(function() {
                            $(this).addClass('panel-default').removeClass('panel-danger has-error');
                            $(this).children('.panel-footer').remove();
                        });
                    });

                    for(var controller in json.errors) {
                        for(var key in json.errors[controller]) {
                            if(json.errors[controller].hasOwnProperty(key)) {
                                notificateUser(json.errors[controller][key]);
                                var ele = $(editForm).find('.'+controller).find('.'+key);
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
