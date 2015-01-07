<div class="modal fade">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Raum erstellen</h4>
            </div>
            <div class="modal-body">
                <form id="roomAddForm">
                    <div class="control-group Room row">
                        <div class="col-xs-12">
                            <div class="panel panel-default name">
                                <div class="panel-heading">Raumname</div>
                                <input type="input" class="form-control panel-body" name="data[Room][name]" placeholder="Raumname">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                <button type="button" class="btn btn-primary" onclick="$('#roomAddForm').submit();">Speichern</button>
            </div>
        </div>
    </div>

    <?php echo $this->Html->scriptStart(array('inline' => true)); ?>

    $('.modal').on('hidden.bs.modal', function (e) {
    $('.modal').remove();
    });

    $('#roomAddForm').submit(function(event) {
    $.post('<?php echo $this->webroot;?>rooms/add/', $('#roomAddForm').serialize(), function(json) {
    if(json.success == true) {
    notificateUser(json.message, 'success');

    $( "#roomEntries" ).trigger({
    type:"roomChanged",
    roomId:json.roomId
    });
    $('.modal').modal('hide');
    } else {
    notificateUser(json.message);

    //delete old errors
    $('#roomAddForm').children().each(function() {
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
    var ele = $('#roomAddForm > .'+controller+' > div > .'+key);
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