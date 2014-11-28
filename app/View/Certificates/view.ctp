<div class="certificates view">
<h2><?php echo __('Certificate'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($certificate['Certificate']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($certificate['Certificate']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($certificate['Certificate']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Certificate'), array('action' => 'edit', $certificate['Certificate']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Certificate'), array('action' => 'delete', $certificate['Certificate']['id']), array(), __('Are you sure you want to delete # %s?', $certificate['Certificate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Certificates'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Certificate'), array('action' => 'add')); ?> </li>
	</ul>
</div>
