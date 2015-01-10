<div class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tarif bearbeiten</h4>
            </div>
            <div class="modal-body">
                <form id="tariffEditForm">
                    <div class="control-group Tariff row">
                        <div class="col-xs-6">
                            <div class="panel panel-default description">
                                <div class="panel-heading">Beschreibung</div>
                                <input type="input" class="form-control panel-body" name="data[Tariff][description]" value="<?php echo $tariff['Tariff']['description'];?>" placeholder="Beschreibung">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default description">
                                <div class="panel-heading">Betrag</div>
                                <input type="input" class="form-control panel-body" name="data[Tariff][amount]" value="<?php echo $tariff['Tariff']['amount'];?>" placeholder="Betrag">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                <button type="button" class="btn btn-primary" onclick="$('#tariffEditForm').submit();">Speichern</button>
            </div>
        </div>
        <?php echo $this->Html->scriptStart(array('inline' => true));?>
        $('.modal').on('hidden.bs.modal', function (e) {
            $('.modal').remove();
        });
        tariffEditFormAddSubmitEvent(<?php echo $tariff['Tariff']['id'];?>);
        <?php echo $this->Html->scriptEnd();?>
    </div>
</div>
