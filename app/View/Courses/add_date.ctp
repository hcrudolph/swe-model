<div class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Termin erstellen</h4>
            </div>
            <div class="modal-body">
                <form id="courseAddDateForm<?php echo $courseId;?>">
                    <div class="control-group Date row">
                        <div class="col-xs-6">
                            <div class="panel panel-default room">
                                <div class="panel-heading">Raum</div>
                                <input type="input" class="form-control panel-body" name="data[Date][room]" placeholder="Raum">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default director">
                                <div class="panel-heading">Trainer</div>
                                <input type="input" class="form-control panel-body" name="data[Date][director]" placeholder="Trainer">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default begin">
                                <div class="panel-heading">Beginn</div>
                                <div class="input-group input-append date">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                    <input type="text" name="data[Date][begin]" class="form-control">
                                    <span class="input-group-addon" onclick="$(this).parent().children('.form-control').val('');">
                                        <i class="glyphicon glyphicon-remove-circle"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default end">
                                <div class="panel-heading">Ende</div>
                                <div class="input-group input-append date">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                    <input type="text" name="data[Date][end]" class="form-control">
                                    <span class="input-group-addon" onclick="$(this).parent().children('.form-control').val('');">
                                        <i class="glyphicon glyphicon-remove-circle"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default mincount">
                                <div class="panel-heading">Minimale Teilnehmerzahl</div>
                                <input type="input" class="form-control panel-body" name="data[Dates][mincount]" placeholder="Minimale Teilnehmerzahl">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default maxcount">
                                <div class="panel-heading">Maximale Teilnehmerzahl</div>
                                <input type="input" class="form-control panel-body" name="data[Dates][maxcount]" placeholder="Maximale Teilnehmerzahl">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                    <button type="button" class="btn btn-primary" onclick="$('#courseAddDateForm<?php echo $courseId;?>').submit();">Speichern</button>
                </div>
            </div>
        </div>
        <?php echo $this->Html->scriptStart(array('inline' => true));?>
        $('.modal').on('hidden.bs.modal', function (e) {
            $('.modal').remove();
        });
        $(function() {
            $("#courseAddDateForm<?php echo $courseId;?> > .Date > .col-xs-6 > .begin > .date > .form-control").datetimepicker({
                language: 'de'
            });
            $("#courseAddDateForm<?php echo $courseId;?> > .Date > .col-xs-6 > .end > .date > .form-control").datetimepicker({
                language: 'de'
            });
        });



        courseAddDateFormAddSubmitEvent(<?php echo $courseId;?>);
        <?php echo $this->Html->scriptEnd();?>
        <style>
            .bootstrap-datetimepicker-widget {
                z-index:1151 !important;
            }
        </style>
    </div>