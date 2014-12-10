<div class="dates form">
<?php echo $this->Form->create('Date'); ?>
	<fieldset>
		<legend><?php echo __('Add Date'); ?></legend>
	<?php
		echo $this->Form->input('course_id');
		echo $this->Form->input('room_id');
        echo $this->Form->input('director');
		echo $this->Form->input('begin');
		echo $this->Form->input('end');
		echo $this->Form->input('presetup');
		echo $this->Form->input('postsetup');
		echo $this->Form->input('Account', array(
            'multiple' => 'multiple',
            'type' => 'select',
        ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Dates'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rooms'), array('controller' => 'rooms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Room'), array('controller' => 'rooms', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts'), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account'), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
	</ul>
</div>
