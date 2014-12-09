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
                postEditClose(postId);
            } else
            {
                alert('nicht gespeichert');
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

<?php /*
<div class="posts form">
<?php echo $this->Form->create('Post'); ?>
	<fieldset>
		<legend><?php echo __('Edit Post'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('account_id');
		echo $this->Form->input('heading');
		echo $this->Form->input('body');
		echo $this->Form->input('visiblebegin');
		echo $this->Form->input('visibleend');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Post.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Post.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Posts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Accounts'), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account'), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
	</ul>
</div>
*/ ?>