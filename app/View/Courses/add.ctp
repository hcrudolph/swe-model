<div class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Kurs erstellen</h4>
            </div>
            <div class="modal-body">
                <form id="courseAddForm">
                    <div class="control-group Course row">
                        <div class="col-xs-6">
                            <div class="panel panel-default name">
                                <div class="panel-heading">Kursname</div>
                                <input type="input" class="form-control panel-body" name="data[Course][name]" placeholder="Kursname">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default level">
                                <div class="panel-heading">Schwierigkeitsgrad</div>
                                <select name="data[Course][level]" class="form-control panel-body" style="padding:0px;">
                                    <option selected>Schwierigkeitsgrad</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="panel panel-default description">
                                <div class="panel-heading">Beschreibung</div>
                                <textarea name="data[Course][description]" class="body form-control panel-body" rows="3" placeholder="Kursbeschreibung"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                <button type="button" class="btn btn-primary" onclick="$('#courseAddForm').submit();">Speichern</button>
            </div>
        </div>
    </div>

    <?php echo $this->Html->scriptStart(array('inline' => true)); ?>

        $('.modal').on('hidden.bs.modal', function (e) {
            $('.modal').remove();
        });

        $('#courseAddForm').submit(function(event) {
            $.post('<?php echo $this->webroot;?>courses/add/', $('#courseAddForm').serialize(), function(json) {
                if(json.success == true) {
                    notificateUser(json.message, 'success');

                    $.get('<?php echo $this->webroot?>courses/listing/', function( data ) {
                        $('#courses').replaceWith(data);
                        $('.modal').modal('hide');
                    });
                } else {
                    notificateUser(json.message);

                    //delete old errors
                    $('#courseAddForm').children().each(function() {
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
                                var ele = $('#courseAddForm > .'+controller+' > div > .'+key);
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