<div class="courseRoomTimes view">
<h2><?php echo __('Course Room Time'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($courseRoomTime['CourseRoomTime']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Course'); ?></dt>
		<dd>
			<?php echo $this->Html->link($courseRoomTime['Course']['name'], array('controller' => 'courses', 'action' => 'view', $courseRoomTime['Course']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Roomid'); ?></dt>
		<dd>
			<?php echo h($courseRoomTime['CourseRoomTime']['roomid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Director'); ?></dt>
		<dd>
			<?php echo h($courseRoomTime['CourseRoomTime']['director']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Begin'); ?></dt>
		<dd>
			<?php echo h($courseRoomTime['CourseRoomTime']['begin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End'); ?></dt>
		<dd>
			<?php echo h($courseRoomTime['CourseRoomTime']['end']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Presetup'); ?></dt>
		<dd>
			<?php echo h($courseRoomTime['CourseRoomTime']['presetup']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Postsetup'); ?></dt>
		<dd>
			<?php echo h($courseRoomTime['CourseRoomTime']['postsetup']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Course Room Time'), array('action' => 'edit', $courseRoomTime['CourseRoomTime']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Course Room Time'), array('action' => 'delete', $courseRoomTime['CourseRoomTime']['id']), array(), __('Are you sure you want to delete # %s?', $courseRoomTime['CourseRoomTime']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Course Room Times'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course Room Time'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
	</ul>
</div>
