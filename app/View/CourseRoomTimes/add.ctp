<div class="courseRoomTimes form">
<?php echo $this->Form->create('CourseRoomTime'); ?>
	<fieldset>
		<legend><?php echo __('Add Course Room Time'); ?></legend>
	<?php
		echo $this->Form->input('courseid');
		echo $this->Form->input('roomid');
		echo $this->Form->input('director');
		echo $this->Form->input('begin');
		echo $this->Form->input('end');
		echo $this->Form->input('presetup');
		echo $this->Form->input('postsetup');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Course Room Times'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
	</ul>
</div>
