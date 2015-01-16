<div class="courseAccounts index">
	<h2><?php echo __('Course Accounts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('course_room_timeid'); ?></th>
			<th><?php echo $this->Paginator->sort('accountid'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($courseAccounts as $courseAccount): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($courseAccount['CourseRoomTime']['courseid'], array('controller' => 'course_room_times', 'action' => 'view', $courseAccount['CourseRoomTime']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($courseAccount['Account']['username'], array('controller' => 'accounts', 'action' => 'view', $courseAccount['Account']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $courseAccount['CourseAccount']['accountid'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $courseAccount['CourseAccount']['accountid'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $courseAccount['CourseAccount']['accountid']), array(), __('Are you sure you want to delete # %s?', $courseAccount['CourseAccount']['accountid'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Course Account'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Course Room Times'), array('controller' => 'course_room_times', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course Room Time'), array('controller' => 'course_room_times', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts'), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account'), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
	</ul>
</div>
