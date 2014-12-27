<div id="certificate">
    <button type="button" id="certificateAddButton" class="btn btn-default" onclick="certificateAdd()"><i class="glyphicon glyphicon-plus"></i>Hinzufügen</button>
    <button type="button" id="certificateCloseButton" class="btn btn-default" onclick="certificateClose()" style="display:none;"><i class="glyphicon glyphicon-minus"></i>Schließen</button>

    <div class="panel-group" id="certificateEntries" role="tablist" aria-multiselectable="true">
        <?php
        for($i=0; $i < sizeof($certificates); $i++) {
            $certificate = $certificates[$i]['Certificate'];
            $description = $certificates[$i]['Description'];
            $certId = $certificate['id'];
            ?>

            <div class="panel panel-default" id="certificateEntry<?php echo $certId; ?>">
                <div class="panel-heading clearfix" role="tab" id="certificateEntryHeading<?php echo $certId; ?>">
                    <h4 class="panel-title pull-left">
                        <a data-toggle="collapse" data-parent="#certificateEntries" data-url="<?php echo $this->webroot;?>certificates/view/<?php echo $certId; ?>" href="#certificateEntryCollapse<?php echo $certId;?>" aria-expanded="false" aria-controls="certificateEntryCollapse<?php echo $certId; ?>">
                            <?php echo h($certificate['certificatename']); ?>
                        </a>
                    </h4>
                    <div class="btn-group pull-right">
                        <a class="btn btn-default btn-sm" href="javascript:void(0)" onclick="certificateDelete(<?php echo $certId; ?>);">Löschen</a>
                    </div>
                </div>
                <div id="certificateEntryCollapse<?php echo $certId;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="certificateEntryHeading<?php echo $certId; ?>">
                    <div class="panel-body"></div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php echo $this->Html->scriptStart(array('inline' => true));?>
function certificateInformationToggle(certId)
{
    $('#certificateEntryInformation'+certId).toggle();
}

function certificateEdit(certId)
{
    $('#certificateEntryInformation'+certId).load('<?php echo $this->webroot."certificates/edit/"?>'+certId);
    $('#certificateEntryInformation'+certId).show();
}

function certificateAdd()
{
    if($('#certificateAddForm').length == 0)
    {
        $.get('<?php echo $this->webroot."certificates/add/";?>', function( data ) {
            $('#certificateEntries').before(data);
        });
    $('#certificateAddButton').toggle();
    $('#certificateCloseButton').toggle();
    }
}

function certificateClose()
{
    $('#certificateAddForm').remove();
    $('#certificateAddButton').toggle();
    $('#certificateCloseButton').toggle();
}

function certificateInformation(certId)
{
    $('#certificateEntryInformation'+certId).load('<?php echo $this->webroot."certificates/view/"?>'+certId);
    $('#certificateEntryInformation'+certId).show();
}

function certificateDelete(certId)
{
    var del = confirm("certificate #" + certId + " löschen?");
    if (del == true) {
    $.post('<?php echo $this->webroot."certificates/delete/"?>'+certId,function(json) {
    if(json.success == true)
    {
        notificatecertificate(json.message, 'success');
        $('#certificateEntry'+certId).remove();
    } else
    {
        notificatecertificate(json.message);
    }
    }, 'json');
    }
}
<?php echo $this->Html->scriptEnd();?>