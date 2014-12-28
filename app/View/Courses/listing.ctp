<div id="course">
    <button type="button" id="courseAddButton" class="btn btn-default" onclick="courseAdd()"><i class="glyphicon glyphicon-plus"></i>Hinzufügen</button>
    <button type="button" id="courseCloseButton" class="btn btn-default" onclick="courseClose()" style="display:none;"><i class="glyphicon glyphicon-minus"></i>Schließen</button>

    <div class="panel-group" id="courseEntries" role="tablist" aria-multiselectable="true">
        <?php
        for($i=0; $i < sizeof($courses); $i++) {
            $course = $courses[$i]['course'];
            $description = $courses[$i]['Description'];
            $coursId = $course['id'];
            ?>

            <div class="panel panel-default" id="courseEntry<?php echo $coursId; ?>">
                <div class="panel-heading clearfix" role="tab" id="courseEntryHeading<?php echo $coursId; ?>">
                    <h4 class="panel-title pull-left">
                        <a data-toggle="collapse" data-parent="#courseEntries" data-url="<?php echo $this->webroot;?>courses/view/<?php echo $coursId; ?>" href="#courseEntryCollapse<?php echo $coursId;?>" aria-expanded="false" aria-controls="courseEntryCollapse<?php echo $coursId; ?>">
                            <?php echo h($course['coursename']); ?>
                        </a>
                    </h4>
                    <div class="btn-group pull-right">
                        <a class="btn btn-default btn-sm" href="javascript:void(0)" onclick="courseDelete(<?php echo $coursId; ?>);">Löschen</a>
                    </div>
                </div>
                <div id="courseEntryCollapse<?php echo $coursId;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="courseEntryHeading<?php echo $coursId; ?>">
                    <div class="panel-body"></div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php echo $this->Html->scriptStart(array('inline' => true));?>
function courseInformationToggle(coursId)
{
$('#courseEntryInformation'+coursId).toggle();
}

function courseEdit(coursId)
{
$('#courseEntryInformation'+coursId).load('<?php echo $this->webroot."courses/edit/"?>'+coursId);
$('#courseEntryInformation'+coursId).show();
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

function courseInformation(coursId)
{
$('#courseEntryInformation'+coursId).load('<?php echo $this->webroot."courses/view/"?>'+coursId);
$('#courseEntryInformation'+coursId).show();
}

function courseDelete(coursId)
{
var del = confirm("course #" + coursId + " löschen?");
if (del == true) {
$.post('<?php echo $this->webroot."courses/delete/"?>'+coursId,function(json) {
if(json.success == true)
{
notificatecourse(json.message, 'success');
$('#courseEntry'+coursId).remove();
} else
{
notificatecourse(json.message);
}
}, 'json');
}
}
<?php echo $this->Html->scriptEnd();?>