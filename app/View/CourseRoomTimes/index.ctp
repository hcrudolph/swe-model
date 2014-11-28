<div class="courseRoomTimes index">
	<h2><?php echo __('Course Room Times'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('courseid'); ?></th>
			<th><?php echo $this->Paginator->sort('roomid'); ?></th>
			<th><?php echo $this->Paginator->sort('director'); ?></th>
			<th><?php echo $this->Paginator->sort('begin'); ?></th>
			<th><?php echo $this->Paginator->sort('end'); ?></th>
			<th><?php echo $this->Paginator->sort('presetup'); ?></th>
			<th><?php echo $this->Paginator->sort('postsetup'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($courseRoomTimes as $courseRoomTime): ?>
	<tr>
		<td><?php echo h($courseRoomTime['CourseRoomTime']['id']); ?>&nbsp;</td>
		<td><?php echo h($courseRoomTime['CourseRoomTime']['courseid']); ?>&nbsp;</td>
		<td><?php echo h($courseRoomTime['CourseRoomTime']['roomid']); ?>&nbsp;</td>
		<td><?php echo h($courseRoomTime['CourseRoomTime']['director']); ?>&nbsp;</td>
		<td><?php echo h($courseRoomTime['CourseRoomTime']['begin']); ?>&nbsp;</td>
		<td><?php echo h($courseRoomTime['CourseRoomTime']['end']); ?>&nbsp;</td>
		<td><?php echo h($courseRoomTime['CourseRoomTime']['presetup']); ?>&nbsp;</td>
		<td><?php echo h($courseRoomTime['CourseRoomTime']['postsetup']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $courseRoomTime['CourseRoomTime']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $courseRoomTime['CourseRoomTime']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $courseRoomTime['CourseRoomTime']['id']), array(), __('Are you sure you want to delete # %s?', $courseRoomTime['CourseRoomTime']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Course Room Time'), array('action' => 'add')); ?></li>
	</ul>
</div>
