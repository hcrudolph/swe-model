<?php
$postId = $data['Post']['id'];
$visibleBegin = (is_null($data['Post']['visiblebegin'])?'':'value="'.date("d.m.Y", strtotime($data['Post']['visiblebegin'])).'"');
$visibleEnd = (is_null($data['Post']['visibleend'])?'':'value="'.date("d.m.Y", strtotime($data['Post']['visibleend'])).'"');

?>
<div id="postEdit<?php echo $postId; ?>">
    <input is="core-input" id="postEditHeading<?php echo $postId;?>" value="<?php echo $data['Post']['heading'];?>" class="heading" placeholder="Betreff">
    <input is="core-input" id="postEditBody<?php echo $postId;?>" value="<?php echo $data['Post']['body'];?>" class="body" multiline placeholder="Body">
    
    <div id="postEditDatepicker<?php echo $postId;?>"class="input-append date input-daterange">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="glyphicon glyphicon-calendar"></i>
            </span>
            <input id="visibleBegin<?php echo $postId;?>"type="text" class="form-control" <?php echo $visibleBegin;?>>
            <span class="input-group-addon" onclick="$(function(){$('#visibleBegin<?php echo $postId;?>').val('');});">
                <i class="glyphicon glyphicon-remove-circle"></i>
            </span>
        </div>
        <span class="add-on">bis</span>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="glyphicon glyphicon-calendar"></i>
            </span>
            <input id="visibleEnd<?php echo $postId;?>" type="text" class="form-control" <?php echo $visibleEnd;?>>
            <span class="input-group-addon" onclick="$(function(){$('#visibleEnd<?php echo $postId;?>').val('');});">
                <i class="glyphicon glyphicon-remove-circle"></i>
            </span>
        </div>
    </div>
    
    <core-tooltip label="Eintrag speichern" active pressed>
        <core-icon-button icon="save" class="save" onclick="postEditSave(<?php echo $postId; ?>)"></core-icon-button>
    </core-tooltip>
    <core-tooltip label="Abbrechen" active pressed>
        <core-icon-button icon="close" class="close" onclick="postEditClose(<?php echo $postId; ?>)"></core-icon-button>
    </core-tooltip>
</div>

<?php echo $this->Html->scriptStart(array('inline' => true)); ?>

$(function(){
   $('#postEditDatepicker<?php echo $postId;?>').datepicker({
      format: 'dd.mm.yyyy'
    });
});

function postEditSave(postId)
{
    $.post('<?php echo $this->webroot;?>posts/edit/'+postId,
        {
            heading:$('#postEditHeading'+postId).val(),
            body:$('#postEditBody'+postId).val(),
            visiblebegin:$('#visibleBegin'+postId).val(),
            visibleend:$('#visibleEnd'+postId).val(),
        }, function(obj) {
            if(obj.inserted == true)
            {
                notificateUser(obj.message, 'success');
                postEditClose(postId);
            } else
            {
                notificateUser(obj.message);
            }
        }, 'json');
}

function postEditClose(postId)
{
    $.get('<?php echo $this->webroot."posts/view/"?>'+postId, function( data ) {
        $('#postEdit'+postId).replaceWith(data);
    });
}
<?php echo $this->Html->scriptEnd();?>