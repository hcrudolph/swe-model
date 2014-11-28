<div class="certificates form">
<?php echo $this->Form->create('Certificate'); ?>
	<fieldset>
		<legend><?php echo __('Edit Certificate'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Certificate.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Certificate.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Certificates'), array('action' => 'index')); ?></li>
	</ul>
</div>
