<?php
$postId = $post['Post']['id'];
$visibleBegin = $post['Post']['visiblebegin'];
$visibleEnd = $post['Post']['visibleend'];

?>
<form id="postEditForm<?php echo $postId;?>">
    <div class="control-group Post">
        <div class="heading">
            <input type="input" class="form-control" name="data[Post][heading]" value="<?php echo $post['Post']['heading'];?>" placeholder="Betreff">
        </div>
        <div class="body">
            <textarea name="data[Post][body]" class="body form-control" rows="3" placeholder="Body"><?php echo $post['Post']['body'];?></textarea>
        </div>
        <div class="visiblebegin">
            <div class="input-group input-append date">
            <span class="input-group-addon">
                <i class="glyphicon glyphicon-calendar"></i>
            </span>
                <input type="text" name="data[Post][visiblebegin]" class="form-control" value="<?php echo $post['Post']['visiblebegin'];?>">
            <span class="input-group-addon" onclick="$(this).parent().children('.form-control').val('');">
                <i class="glyphicon glyphicon-remove-circle"></i>
            </span>
            </div>
        </div>
        <div class="visibleend">
            <div class="input-group input-append date">
            <span class="input-group-addon">
                <i class="glyphicon glyphicon-calendar"></i>
            </span>
                <input type="text" name="data[Post][visibleend]" class="form-control" value="<?php echo $post['Post']['visibleend'];?>">
            <span class="input-group-addon" onclick="$(this).parent().children('.form-control').val('');">
                <i class="glyphicon glyphicon-remove-circle"></i>
            </span>
            </div>
        </div>
    </div>


    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-floppy-disk"></i>Speichern</button>
    <button type="button" class="btn btn-default" onclick="postEditFormClose(<?php echo $postId; ?>)"><i class="glyphicon glyphicon-minus"></i>Schließen</button>
</form>

<?php echo $this->Html->scriptStart(array('inline' => true)); ?>
    postEditFormAddDatepicker(<?php echo $postId;?>);
    postEditFormAddSubmitEvent(<?php echo $postId;?>);
<?php echo $this->Html->scriptEnd();?>