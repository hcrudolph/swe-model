<div class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Zertifikat bearbeiten</h4>
            </div>
            <div class="modal-body">
                            <form id="certificateEditForm<?php echo $certificate['Certificate']['id'];?>">
                                <div class="control-group certificate row">
                                    <div class="col-xs-6">
                                        <div class="panel panel-default name">
                                            <div class="panel-heading">Zertifikat</div>
                                            <input type="input" class="form-control panel-body" name="data[certificate][name]" value="<?php echo $certificate['Certificate']['name'];?>" placeholder="Zertifikat">
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="panel panel-default description">
                                            <div class="panel-heading">Beschreibung</div>
                                            <textarea name="data[certificate][description]" class="body form-control panel-body" rows="3" placeholder="Beschreibung des Zertifikat"><?php echo $certificate['Certificate']['description'];?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
            </div>
        </div>
        <?php echo $this->Html->scriptStart(array('inline' => true));?>
        $('#certificateEditTabbar > .nav-tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
        });
        $('.modal').on('hidden.bs.modal', function (e) {
        $('.modal').remove();
        $('.bootstrap-datetimepicker-widget').remove();
        });
        certificateEditFormAddSubmitEvent(<?php echo $certificate['certificate']['id'];?>);
        <?php echo $this->Html->scriptEnd();?>
    </div>