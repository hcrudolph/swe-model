<div class="courseAccounts view">
<h2><?php echo __('Course Account'); ?></h2>
	<dl>
		<dt><?php echo __('Course Room Time'); ?></dt>
		<dd>
			<?php echo $this->Html->link($courseAccount['CourseRoomTime']['courseid'], array('controller' => 'course_room_times', 'action' => 'view', $courseAccount['CourseRoomTime']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Account'); ?></dt>
		<dd>
			<?php echo $this->Html->link($courseAccount['Account']['username'], array('controller' => 'accounts', 'action' => 'view', $courseAccount['Account']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Course Account'), array('action' => 'edit', $courseAccount['CourseAccount']['accountid'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Course Account'), array('action' => 'delete', $courseAccount['CourseAccount']['accountid']), array(), __('Are you sure you want to delete # %s?', $courseAccount['CourseAccount']['accountid'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Course Accounts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course Account'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Course Room Times'), array('controller' => 'course_room_times', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course Room Time'), array('controller' => 'course_room_times', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts'), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account'), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
	</ul>
</div>
