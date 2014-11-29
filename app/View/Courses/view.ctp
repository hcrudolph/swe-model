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
		<li><?php echo $this->Html->link(__('List Course Room Times'), array('controller' => 'course_room_times', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course Room Time'), array('controller' => 'course_room_times', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Course Room Times'); ?></h3>
	<?php if (!empty($course['CourseRoomTime'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Courseid'); ?></th>
		<th><?php echo __('Roomid'); ?></th>
		<th><?php echo __('Director'); ?></th>
		<th><?php echo __('Begin'); ?></th>
		<th><?php echo __('End'); ?></th>
		<th><?php echo __('Presetup'); ?></th>
		<th><?php echo __('Postsetup'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($course['CourseRoomTime'] as $courseRoomTime): ?>
		<tr>
			<td><?php echo $courseRoomTime['id']; ?></td>
			<td><?php echo $courseRoomTime['courseid']; ?></td>
			<td><?php echo $courseRoomTime['roomid']; ?></td>
			<td><?php echo $courseRoomTime['director']; ?></td>
			<td><?php echo $courseRoomTime['begin']; ?></td>
			<td><?php echo $courseRoomTime['end']; ?></td>
			<td><?php echo $courseRoomTime['presetup']; ?></td>
			<td><?php echo $courseRoomTime['postsetup']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'course_room_times', 'action' => 'view', $courseRoomTime['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'course_room_times', 'action' => 'edit', $courseRoomTime['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'course_room_times', 'action' => 'delete', $courseRoomTime['id']), array(), __('Are you sure you want to delete # %s?', $courseRoomTime['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Course Room Time'), array('controller' => 'course_room_times', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
