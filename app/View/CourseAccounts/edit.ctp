<div class="courseAccounts form">
<?php echo $this->Form->create('CourseAccount'); ?>
	<fieldset>
		<legend><?php echo __('Edit Course Account'); ?></legend>
	<?php
		echo $this->Form->input('course_room_timeid');
		echo $this->Form->input('accountid');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('CourseAccount.accountid')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('CourseAccount.accountid'))); ?></li>
		<li><?php echo $this->Html->link(__('List Course Accounts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Course Room Times'), array('controller' => 'course_room_times', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course Room Time'), array('controller' => 'course_room_times', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts'), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account'), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
	</ul>
</div>
