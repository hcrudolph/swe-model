<div class="courses view">
<h2><?php echo __('Course'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($course['Course']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($course['Course']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo h($course['Course']['category']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Maxcount'); ?></dt>
		<dd>
			<?php echo h($course['Course']['maxcount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mincount'); ?></dt>
		<dd>
			<?php echo h($course['Course']['mincount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($course['Course']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($course['Course']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Course'), array('action' => 'edit', $course['Course']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Course'), array('action' => 'delete', $course['Course']['id']), array(), __('Are you sure you want to delete # %s?', $course['Course']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Courses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Dates'), array('controller' => 'dates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Date'), array('controller' => 'dates', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Dates'); ?></h3>
	<?php if (!empty($course['Date'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Course Id'); ?></th>
		<th><?php echo __('Room Id'); ?></th>
		<th><?php echo __('Director'); ?></th>
		<th><?php echo __('Begin'); ?></th>
		<th><?php echo __('End'); ?></th>
		<th><?php echo __('Presetup'); ?></th>
		<th><?php echo __('Postsetup'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($course['Date'] as $date): ?>
		<tr>
			<td><?php echo $date['id']; ?></td>
			<td><?php echo $date['course_id']; ?></td>
			<td><?php echo $date['room_id']; ?></td>
			<td><?php echo $date['director']; ?></td>
			<td><?php echo $date['begin']; ?></td>
			<td><?php echo $date['end']; ?></td>
			<td><?php echo $date['presetup']; ?></td>
			<td><?php echo $date['postsetup']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'dates', 'action' => 'view', $date['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'dates', 'action' => 'edit', $date['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'dates', 'action' => 'delete', $date['id']), array(), __('Are you sure you want to delete # %s?', $date['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Date'), array('controller' => 'dates', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
