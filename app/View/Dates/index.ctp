<div class="dates index">
	<h2><?php echo __('Dates'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('course_id'); ?></th>
			<th><?php echo $this->Paginator->sort('room_id'); ?></th>
			<th><?php echo $this->Paginator->sort('director'); ?></th>
			<th><?php echo $this->Paginator->sort('begin'); ?></th>
			<th><?php echo $this->Paginator->sort('end'); ?></th>
			<th><?php echo $this->Paginator->sort('presetup'); ?></th>
			<th><?php echo $this->Paginator->sort('postsetup'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($dates as $date): ?>
	<tr>
		<td><?php echo h($date['Date']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($date['Course']['name'], array('controller' => 'courses', 'action' => 'view', $date['Course']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($date['Room']['name'], array('controller' => 'rooms', 'action' => 'view', $date['Room']['id'])); ?>
		</td>
		<td><?php echo h($date['Date']['director']); ?>&nbsp;</td>
		<td><?php echo h($date['Date']['begin']); ?>&nbsp;</td>
		<td><?php echo h($date['Date']['end']); ?>&nbsp;</td>
		<td><?php echo h($date['Date']['presetup']); ?>&nbsp;</td>
		<td><?php echo h($date['Date']['postsetup']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $date['Date']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $date['Date']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $date['Date']['id']), array(), __('Are you sure you want to delete # %s?', $date['Date']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Date'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rooms'), array('controller' => 'rooms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Room'), array('controller' => 'rooms', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts'), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account'), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
	</ul>
</div>
