<div id="tariff">
    <button type="button" id="tariffAddButton" class="btn btn-default" onclick="tariffAdd()"><i class="glyphicon glyphicon-plus"></i>Hinzufügen</button>
    <button type="button" id="tariffCloseButton" class="btn btn-default" onclick="tariffClose()" style="display:none;"><i class="glyphicon glyphicon-minus"></i>Schließen</button>

    <div class="panel-group" id="tariffEntries" role="tablist" aria-multiselectable="true">
        <?php
        for($i=0; $i < sizeof($tariffs); $i++) {
            $tariff = $tariffs[$i]['description'];
            $discount = $tariffs[$i]['amount'];
            $tarId = $tariff['id'];
            ?>

            <div class="panel panel-default" id="tariffEntry<?php echo $tarId; ?>">
                <div class="panel-heading clearfix" role="tab" id="tariffEntryHeading<?php echo $tarId; ?>">
                    <h4 class="panel-title pull-left">
                        <a data-toggle="collapse" data-parent="#tariffEntries" data-url="<?php echo $this->webroot;?>tariffs/view/<?php echo $tarId; ?>" href="#tariffEntryCollapse<?php echo $tarId;?>" aria-expanded="false" aria-controls="tariffEntryCollapse<?php echo $tarId; ?>">
                            <?php echo h($tariff['tariffname']); ?>
                        </a>
                    </h4>
                    <div class="btn-group pull-right">
                        <a class="btn btn-default btn-sm" href="javascript:void(0)" onclick="tariffDelete(<?php echo $tarId; ?>);">Löschen</a>
                    </div>
                </div>
                <div id="tariffEntryCollapse<?php echo $tarId;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tariffEntryHeading<?php echo $tarId; ?>">
                    <div class="panel-body"></div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php echo $this->Html->scriptStart(array('inline' => true));?>
function tariffInformationToggle(tarId)
{
    $('#tariffEntryInformation'+tarId).toggle();
}

function tariffEdit(tarId)
{
    $('#tariffEntryInformation'+tarId).load('<?php echo $this->webroot."tariffs/edit/"?>'+tarId);
    $('#tariffEntryInformation'+tarId).show();
}

function tariffAdd()
{
    if($('#tariffAddForm').length == 0)
    {
        $.get('<?php echo $this->webroot."tariffs/add/";?>', function( data ) {
            $('#tariffEntries').before(data);
        });
    $('#tariffAddButton').toggle();
    $('#tariffCloseButton').toggle();
    }
}

function tariffClose()
{
    $('#tariffAddForm').remove();
    $('#tariffAddButton').toggle();
    $('#tariffCloseButton').toggle();
}

function tariffInformation(tarId)
{
    $('#tariffEntryInformation'+tarId).load('<?php echo $this->webroot."tariffs/view/"?>'+tarId);
    $('#tariffEntryInformation'+tarId).show();
}

function tariffDelete(tarId)
{
    var del = confirm("tariff #" + tarId + " löschen?");
    if (del == true) {
    $.post('<?php echo $this->webroot."tariffs/delete/"?>'+tarId,function(json) {
        if(json.success == true)
        {
            notificatetariff(json.message, 'success');
            $('#tariffEntry'+tarId).remove();
        } else
        {
            notificatetariff(json.message);
        }
    }, 'json');
    }
}
<?php echo $this->Html->scriptEnd();?>