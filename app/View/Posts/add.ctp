<!--<div id="postEntryAdd">
    <core-input placeholder="Betreff"></core-input>
    <core-input multiline placeholder="Text"></core-input>
</div>-->


<div class="posts form">
<?php echo $this->Form->create('Post'); ?>
	<fieldset>
		<legend><?php echo __('Add Post'); ?></legend>
	<?php
		echo $this->Form->input('account_id');
		echo $this->Form->input('heading');
		echo $this->Form->input('body');
		echo $this->Form->input('visiblebegin');
		echo $this->Form->input('visibleend');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>