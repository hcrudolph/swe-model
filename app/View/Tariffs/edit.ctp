<div class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Kurs bearbeiten</h4>
            </div>
            <div class="modal-body">
                            <form id="tariffEditForm<?php echo $tariff['tariff']['id'];?>">
                                <div class="col-xs-12">
                                    <div class="panel panel-default description">
                                        <div class="panel-heading">Tarifbeschreibung</div>
                                        <textarea name="data[tariff][description]" class="body form-control panel-body" rows="3" placeholder="Tarifbeschreibung"><?php echo $tariff['tariff']['description'];?></textarea>
                                    </div>
                                </div>
                                <div class="control-group tariff row">
                                    <div class="col-xs-6">
                                        <div class="panel panel-default name">
                                            <div class="panel-heading">Betrag</div>
                                            <input type="input" class="form-control panel-body" name="data[tariff][amount]" value="<?php echo $tariff['tariff']['amount'];?>" placeholder="Betrag">
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="panel panel-default name">
                                            <div class="panel-heading">Laufzeit</div>
                                            <input type="input" class="form-control panel-body" name="data[tariff][term]" value="<?php echo $tariff['tariff']['term'];?>" placeholder="Laufzeit in Monaten">
                                        </div>
                                    </div>
                                </div>
                            </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                    <button type="button" class="btn btn-primary" onclick="$('#tariffEditForm<?php echo $tariff['tariff']['id'];?>').submit();">Speichern</button>
                </div>
            </div>
        </div>
        <?php echo $this->Html->scriptStart(array('inline' => true));?>
        $('#tariffEditTabbar > .nav-tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
        });
        $('.modal').on('hidden.bs.modal', function (e) {
        $('.modal').remove();
        $('.bootstrap-datetimepicker-widget').remove();
        });
        tariffEditFormAddSubmitEvent(<?php echo $tariff['tariff']['id'];?>);
        <?php echo $this->Html->scriptEnd();?>
    </div>