<?php $postId = $data['Post']['id']; ?>
<div id="postEdit<?php echo $postId; ?>">
    <input is="core-input" id="postEditHeading<?php echo $postId;?>" value="<?php echo $data['Post']['heading'];?>" class="heading" placeholder="Betreff">
    <input is="core-input" id="postEditBody<?php echo $postId;?>" value="<?php echo $data['Post']['body'];?>" class="body" multiline placeholder="Body">
    <input is="core-input" id="postEditDate<?php echo $postId;?>" class="date" multiline placeholder="Date">
    <date-picker class="date"></date-picker>
    <core-tooltip label="Eintrag speichern" active pressed>
        <core-icon-button icon="save" class="save" onclick="postEditSave(<?php echo $postId; ?>)"></core-icon-button>
    </core-tooltip>
    <core-tooltip label="Abbrechen" active pressed>
        <core-icon-button icon="close" class="close" onclick="postEditClose(<?php echo $postId; ?>)"></core-icon-button>
    </core-tooltip>
</div>

<?php echo $this->Html->scriptStart(array('inline' => true)); ?>
function postEditSave(postId)
{
    $.post('<?php echo $this->webroot;?>posts/edit/'+postId,
        {
            heading:$('#postEditHeading'+postId).val(),
            body:$('#postEditBody'+postId).val(),
            //date:""
        }, function(obj) {
            if(obj.inserted == true)
            {
                notificateUser(obj.message, 'success');
                postEditClose(postId);
            } else
            {
                notificateUser(obj.Message);
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