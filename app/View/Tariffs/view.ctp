<div class="tariffs view">
<h2><?php echo __('Tariff'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($tariff['Tariff']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($tariff['Tariff']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($tariff['Tariff']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo h($tariff['Tariff']['role']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Course'); ?></dt>
		<dd>
			<?php echo $this->Html->link($tariff['Course']['name'], array('controller' => 'courses', 'action' => 'view', $tariff['Course']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tariff'), array('action' => 'edit', $tariff['Tariff']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Tariff'), array('action' => 'delete', $tariff['Tariff']['id']), array(), __('Are you sure you want to delete # %s?', $tariff['Tariff']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tariffs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tariff'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
	</ul>
</div>
