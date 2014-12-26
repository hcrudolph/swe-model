<div id="course">
    <button type="button" id="courseAddButton" class="btn btn-default" onclick="courseAdd()"><i class="glyphicon glyphicon-plus"></i>Hinzufügen</button>
    <button type="button" id="courseCloseButton" class="btn btn-default" onclick="courseClose()" style="display:none;"><i class="glyphicon glyphicon-minus"></i>Schließen</button>

    <div class="panel-group" id="courseEntries" role="tablist" aria-multiselectable="true">
        <?php
        for($i=0; $i < sizeof($courses); $i++) {
            $course = $courses[$i]['course'];
            $description = $courses[$i]['Description'];
            $certId = $course['id'];
            ?>

            <div class="panel panel-default" id="courseEntry<?php echo $certId; ?>">
                <div class="panel-heading clearfix" role="tab" id="courseEntryHeading<?php echo $certId; ?>">
                    <h4 class="panel-title pull-left">
                        <a data-toggle="collapse" data-parent="#courseEntries" data-url="<?php echo $this->webroot;?>courses/view/<?php echo $certId; ?>" href="#courseEntryCollapse<?php echo $certId;?>" aria-expanded="false" aria-controls="courseEntryCollapse<?php echo $certId; ?>">
                            <?php echo h($course['coursename']); ?>
                        </a>
                    </h4>
                    <div class="btn-group pull-right">
                        <a class="btn btn-default btn-sm" href="javascript:void(0)" onclick="courseDelete(<?php echo $certId; ?>);">Löschen</a>
                    </div>
                </div>
                <div id="courseEntryCollapse<?php echo $certId;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="courseEntryHeading<?php echo $certId; ?>">
                    <div class="panel-body"></div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php echo $this->Html->scriptStart(array('inline' => true));?>
function courseInformationToggle(certId)
{
$('#courseEntryInformation'+certId).toggle();
}

function courseEdit(certId)
{
$('#courseEntryInformation'+certId).load('<?php echo $this->webroot."courses/edit/"?>'+certId);
$('#courseEntryInformation'+certId).show();
}

function courseAdd()
{
if($('#courseAddForm').length == 0)
{
$.get('<?php echo $this->webroot."courses/add/";?>', function( data ) {
$('#courseEntries').before(data);
});
$('#courseAddButton').toggle();
$('#courseCloseButton').toggle();
}
}

function courseClose()
{
$('#courseAddForm').remove();
$('#courseAddButton').toggle();
$('#courseCloseButton').toggle();
}

function courseInformation(certId)
{
$('#courseEntryInformation'+certId).load('<?php echo $this->webroot."courses/view/"?>'+certId);
$('#courseEntryInformation'+certId).show();
}

function courseDelete(certId)
{
var del = confirm("course #" + certId + " löschen?");
if (del == true) {
$.post('<?php echo $this->webroot."courses/delete/"?>'+certId,function(json) {
if(json.success == true)
{
notificatecourse(json.message, 'success');
$('#courseEntry'+certId).remove();
} else
{
notificatecourse(json.message);
}
}, 'json');
}
}
