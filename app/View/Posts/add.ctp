<?php
    $addId = ((isset($addId))?$addId:'');
?>

<div id="postAdd<?php echo $addId;?>" class="postAdd">
    <input id="postAddHeading<?php echo $addId;?>" class="heading form-control" placeholder="Betreff">
    <textarea id="postAddBody<?php echo $addId;?>" class="body form-control" rows="3" placeholder="Body"></textarea>
    <div id="postAddDatepicker<?php echo $addId;?>"class="input-append date input-daterange">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="glyphicon glyphicon-calendar"></i>
            </span>
            <input id="postAddVisibleBegin<?php echo $addId;?>"type="text" class="form-control">
            <span class="input-group-addon" onclick="$(function(){$('#visibleBegin<?php echo $addId;?>').val('');});">
                <i class="glyphicon glyphicon-remove-circle"></i>
            </span>
        </div>
        <span class="add-on">bis</span>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="glyphicon glyphicon-calendar"></i>
            </span>
            <input id="postAddVisibleEnd<?php echo $addId;?>" type="text" class="form-control">
            <span class="input-group-addon" onclick="$(function(){$('#visibleEnd<?php echo $addId;?>').val('');});">
                <i class="glyphicon glyphicon-remove-circle"></i>
            </span>
        </div>
    </div>
    
    <core-tooltip label="Eintrag speichern" active pressed>
        <core-icon-button icon="save" class="save" onclick="postAddSubmit(<?php echo $addId;?>)"></core-icon-button>
    </core-tooltip>
    <core-tooltip label="Abbrechen" active pressed>
        <core-icon-button icon="close" class="close" onclick="postAddClose(<?php echo $addId;?>)"></core-icon-button>
    </core-tooltip>
    <?php echo $this->Html->scriptStart(array('inline' => true)); ?>
    <?php echo $this->Html->scriptEnd(); ?>
</div>

<?php echo $this->Html->scriptStart(array('inline' => true)); ?>
$(function(){
    $('#postAddDatepicker<?php echo $addId;?>').datepicker({
        format: 'dd.mm.yyyy',
        language: 'de'
    });
});

function postAddSubmit(addId)
{
    $.post('<?php echo $this->webroot;?>posts/add/'+addId,
        {
            heading:$('#postAddHeading'+addId).val(),
            body:$('#postAddBody'+addId).val(),
            visiblebegin:$('#postAddVisibleBegin'+addId).val(),
            visibleend:$('#postAddVisibleEnd'+addId).val(),
        }, function(obj) {
            if(obj.inserted == true)
            {
                notificateUser(obj.message, 'success');
                $.get('<?php echo $this->webroot."posts/view/"?>'+obj.id, function( data ) {
                    $('#postEntries').prepend(data);
                    postAddClose(addId);
                });
            } else
            {
                notificateUser(obj.message);
            }
        }, 'json');
}

function postAddClose(addId)
{
    $('#postAdd'+addId).remove();
}
<?php echo $this->Html->scriptEnd();?>