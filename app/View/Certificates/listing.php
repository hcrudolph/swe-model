<div>
    <button type="button" class="btn btn-default" onclick="certificateAdd()"><i class="glyphicon glyphicon-plus"></i>Hinzufügen</button>
</div>
<div id="certificateEntries">
    <?php
    foreach($certificatesListing as $certificateListing)
    {
        $certificate = $certificateListing['Zertifikat'];
        $description = $certificateListing['Bezeichnung'];
        $cetId = $certificate['id'];

        echo '<div id="certificateEntry'.$cetId.'">';
        echo '<div onclick="certificateInformationToggle('.$cetId.')">';
        echo h($certificate['certificatename']);
        echo '</div>';
        echo '<button type="button" class="btn btn-default" onclick="certificateEdit('.$cetId.')"><i class="glyphicon glyphicon-pencil"></i>Bearbeiten</button>';
        echo '<button type="button" class="btn btn-default" onclick="certificateInformation('.$cetId.')"><i class="glyphicon glyphicon-info-sign"></i>Informationen</button>';
        echo '<button type="button" class="btn btn-default" onclick="certificateDelete('.$cetId.')"><i class="glyphicon glyphicon-trash"></i>Löschen</button>';
        echo '<div id="certificateEntryInformation'.$cetId.'" style="display:none;"></div>';
        echo "</div>";
    }
    ?>
</div>

<?php echo $this->Html->scriptStart(array('inline' => true));?>
function certificateInformationToggle(cetId)
{
    $('#certificateEntryInformation'+cetId).toggle();
}

function certificateEdit(cetId)
{
    $('#certificateEntryInformation'+cetId).load('<?php echo $this->webroot."certificates/edit/"?>'+cetId);
    $('#certificateEntryInformation'+cetId).show();
}

function certificateAdd()
{
    $(#certificateEntryInformation).load(<?php echo $this->webroot."certificates/add/"?>);
    $(#certificateEntryInformation).show();
}

function certificateInformation(cetId)
{
    $('#certificateEntryInformation'+cetId).load('<?php echo $this->webroot."certificates/view/"?>'+cetId);
    $('#certificateEntryInformation'+cetId).show();
}

function certificateDelete(cetId)
{
    var del = confirm("certificate #" + cetId + " löschen?");
    if (del == true) {
    $.post('<?php echo $this->webroot."certificates/delete/"?>'+cetId,function(json) {
    if(json.success == true)
    {
        notificatecertificate(json.message, 'success');
        $('#certificateEntry'+cetId).remove();
    } else
    {
        notificatecertificate(json.message);
    }
    }, 'json');
    }
}