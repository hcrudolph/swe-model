<div class="courses form">
<?php echo $this->Form->create('Course'); ?>
	<fieldset>
		<legend><?php echo __('Add Course'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('category');
		echo $this->Form->input('maxcount');
		echo $this->Form->input('mincount');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Courses'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Course Room Times'), array('controller' => 'course_room_times', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course Room Time'), array('controller' => 'course_room_times', 'action' => 'add')); ?> </li>
	</ul>
</div>
