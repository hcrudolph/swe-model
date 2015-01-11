<div class="modal fade">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Raum bearbeiten</h4>
            </div>
            <div class="modal-body">
                <form id="roomEditForm<?php echo $room['Room']['id'];?>">
                    <div class="control-group Room row">
                        <div class="col-xs-12">
                            <div class="panel panel-default name">
                                <div class="panel-heading">Raumname</div>
                                <input type="input" class="form-control panel-body" name="data[Room][name]" value="<?php echo $room['Room']['name'];?>" placeholder="Raumname">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                <button type="button" class="btn btn-primary" onclick="$('#roomEditForm<?php echo $room['Room']['id'];?>').submit();">Speichern</button>
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
        roomEditFormAddSubmitEvent(<?php echo $room['Room']['id'];?>);
        <?php echo $this->Html->scriptEnd();?>
    </div>