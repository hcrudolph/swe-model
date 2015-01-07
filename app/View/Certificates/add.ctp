<div class="modal fade">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Zertifikat erstellen</h4>
            </div>
            <div class="modal-body">
                <form id="certificateAddForm">
                    <div class="control-group Certificate row">
                        <div class="col-xs-12">
                            <div class="panel panel-default name">
                                <div class="panel-heading">Zertifikat</div>
                                <input type="input" class="form-control panel-body" name="data[Certificate][name]" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="panel panel-default description">
                                <div class="panel-heading">Beschreibung</div>
                                <textarea name="data[Certificate][description]" class="body form-control panel-body" rows="3" placeholder="Beschreibung"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                <button type="button" class="btn btn-primary" onclick="$('#certificateAddForm').submit();">Speichern</button>
            </div>
        </div>
    </div>

    <?php echo $this->Html->scriptStart(array('inline' => true)); ?>

    $('.modal').on('hidden.bs.modal', function (e) {
        $('.modal').remove();
    });

    $('#certificateAddForm').submit(function(event) {
        $.post('<?php echo $this->webroot;?>certificates/add/', $('#certificateAddForm').serialize(), function(json) {
            if(json.success == true) {
                notificateUser(json.message, 'success');

                $( "#certificateEntries" ).trigger({
                    type:"certificateChanged",
                    certificateId:json.certificateId
                });
                $('.modal').modal('hide');
            } else {
                notificateUser(json.message);

                //delete old errors
                $('#certificateAddForm').children().each(function() {
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
                            var ele = $('#certificateAddForm > .'+controller+' > div > .'+key);
                            ele.addClass('panel-danger has-error');
                            ele.append('<div class="panel-footer">'+json.errors[controller][key]+'</div>');
                        }
                    }
                }
            }
        }, 'json');
        event.preventDefault();
    });
    <?php echo $this->Html->scriptEnd(); ?>
</div>