<div class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tarif erstellen</h4>
            </div>
            <div class="modal-body">
                <form id="tariffAddForm">
                    <div class="control-group Tariff row">
                        <div class="col-xs-6">
                            <div class="panel panel-default description">
                                <div class="panel-heading">Beschreibung</div>
                                <input type="input" class="form-control panel-body" name="data[Tariff][description]" placeholder="Beschreibung">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default amount">
                                <div class="panel-heading">Betrag</div>
                                <input type="input" class="form-control panel-body" name="data[Tariff][amount]" placeholder="Betrag">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                <button type="button" class="btn btn-primary" onclick="$('#tariffAddForm').submit();">Speichern</button>
            </div>
        </div>
    </div>

    <?php echo $this->Html->scriptStart(array('inline' => true)); ?>

    $('.modal').on('hidden.bs.modal', function (e) {
        $('.modal').remove();
    });

    $('#tariffAddForm').submit(function(event) {
        $.post('<?php echo $this->webroot;?>tariffs/add/', $('#tariffAddForm').serialize(), function(json) {
            if(json.success == true) {
                notificateUser(json.message, 'success');

                $( "#tariffEntries" ).trigger({
                    type:"tariffChanged",
                    tariffId:json.tariffId
                });
                $('.modal').modal('hide');
            } else {
                notificateUser(json.message);

                //delete old errors
                $('#tariffAddForm').children().each(function() {
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
                            var ele = $('#tariffAddForm > .'+controller+' > div > .'+key);
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
