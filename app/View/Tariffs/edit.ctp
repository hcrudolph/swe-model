<div class="tariffs form">
<?php echo $this->Form->create('Tariff'); ?>
	<fieldset>
		<legend><?php echo __('Edit Tariff'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('description');
		echo $this->Form->input('amount');
		echo $this->Form->input('role');
		echo $this->Form->input('course_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Tariff.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Tariff.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Tariffs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
	</ul>
</div>
