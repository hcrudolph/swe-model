<?php
$postId = $data['Post']['id'];
$visibleBegin = (is_null($data['Post']['visiblebegin'])?'':'value="'.date("d.m.Y", strtotime($data['Post']['visiblebegin'])).'"');
$visibleEnd = (is_null($data['Post']['visibleend'])?'':'value="'.date("d.m.Y", strtotime($data['Post']['visibleend'])).'"');

?>
<div id="postEdit<?php echo $postId; ?>">
    <input id="postEditHeading<?php echo $postId;?>" class="heading form-control" value="<?php echo $data['Post']['heading'];?>">
    <textarea id="postEditBody<?php echo $postId;?>" class="body form-control" rows="3"><?php echo $data['Post']['body'];?></textarea>
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

    <button type="button" id="postAddSaveButton" class="btn btn-default" onclick="postEditSave(<?php echo $postId; ?>)"><i class="glyphicon glyphicon-floppy-disk"></i>Speichern</button>
    <button type="button" id="postAddCloseButton" class="btn btn-default" onclick="postEditClose(<?php echo $postId; ?>)"><i class="glyphicon glyphicon-minus"></i>Schließen</button>
</div>

<?php echo $this->Html->scriptStart(array('inline' => true)); ?>

$(function(){
   $('#postEditDatepicker<?php echo $postId;?>').datepicker({
      format: 'dd.mm.yyyy',
      language: "de"
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