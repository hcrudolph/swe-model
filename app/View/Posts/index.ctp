<?php
if(!empty($user))
{?>
<core-tooltip label="Eintrag hinzufügen" active pressed id="core_tooltip2">
    <core-icon-button icon="add-circle-outline" id="postsButtonAdd" onclick="postsButtonAddClick();"></core-icon-button>
</core-tooltip>
<?php
}
echo $this->Html->scriptStart(array('inline' => true));
?>
var addId = 0;
function postsButtonAddClick()
{
    $.get('<?php echo $this->webroot."posts/add/";?>'+addId, function( data ) {
        $('#postEntries').before(data);
    });
    addId++;
}
<?php echo $this->Html->scriptEnd();?>

<div id="postEntries">
    <?php
    foreach ($posts as $post)
    {
        echo $this->element('post', array('post' => $post));
    }
    ?>
</div>
<?php echo $this->Html->scriptStart(array('inline' => true)); ?>
function postEntryDelete(id)
{
    var del = confirm("Post #" + id + " löschen?");
    if (del == true) {
        $.post('<?php echo $this->webroot."posts/delete/"?>'+id,function(json) {
            if(json.success == true)
            {
                notificateUser(json.message, 'success');
                $('#postEntry'+id).remove();
            } else
            {
                notificateUser(json.message);
            }
        }, 'json');
    }
}

function postEntryEdit(id)
{
    $.get('<?php echo $this->webroot."posts/edit/"?>'+id, function( data ) {
        $('#postEntry'+id).replaceWith(data);
    });
}
<?php echo $this->Html->scriptEnd();?>
