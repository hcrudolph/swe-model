<div id="postAdd<?php echo ((isset($addId))?$addId:'');?>" class="postAdd">
    <input is="core-input" id="postAddHeading<?php echo ((isset($addId))?$addId:'');?>" class="heading" placeholder="Betreff">
    <input is="core-input" id="postAddBody<?php echo ((isset($addId))?$addId:'');?>" class="body" multiline placeholder="Body">
    <input is="core-input" id="postAddDate<?php echo ((isset($addId))?$addId:'');?>" class="date" multiline placeholder="Date">
    <date-picker class="date"></date-picker>
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
function postAddSubmit(addId)
{
    $.post('<?php echo $this->webroot;?>posts/add/'+addId,
        {
            heading:$('#postAddHeading'+addId).val(),
            body:$('#postAddBody'+addId).val(),
            //date:""
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