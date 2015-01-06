<div class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Kurs bearbeiten</h4>
            </div>
            <div class="modal-body">
                <div id="roomEditTabbar" role="tabpanel">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#roomEditData">Kursdaten</a></li>
                        <li role="presentation"><a href="#roomEditPlanner">Terminplaner</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="roomEditData">
                            <form id="roomEditForm<?php echo $room['Room']['id'];?>">
                                <div class="control-group room row">
                                    <div class="col-xs-6">
                                        <div class="panel panel-default name">
                                            <div class="panel-heading">Raumname</div>
                                            <input type="input" class="form-control panel-body" name="data[room][name]" value="<?php echo $room['room']['name'];?>" placeholder="Raumname">
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="panel panel-default description">
                                            <div class="panel-heading">Beschreibung</div>
                                            <textarea name="data[room][description]" class="body form-control panel-body" rows="3" placeholder="Raumbeschreibung"><?php echo $room['room']['description'];?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="roomEditPlanner"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                    <button type="button" class="btn btn-primary" onclick="$('#roomEditForm<?php echo $room['room']['id'];?>').submit();">Speichern</button>
                </div>
            </div>
        </div>
        <?php echo $this->Html->scriptStart(array('inline' => true));?>
        $('#roomEditTabbar > .nav-tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
        });
        $('.modal').on('hidden.bs.modal', function (e) {
        $('.modal').remove();
        $('.bootstrap-datetimepicker-widget').remove();
        });
        roomEditFormAddSubmitEvent(<?php echo $room['room']['id'];?>);
        <?php echo $this->Html->scriptEnd();?>
    </div>