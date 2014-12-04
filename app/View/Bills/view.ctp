<div class="bills view">
<h2><?php echo __('Bill'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($bill['Bill']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Account'); ?></dt>
		<dd>
			<?php echo $this->Html->link($bill['Account']['username'], array('controller' => 'accounts', 'action' => 'view', $bill['Account']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Year'); ?></dt>
		<dd>
			<?php echo h($bill['Bill']['year']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Month'); ?></dt>
		<dd>
			<?php echo h($bill['Bill']['month']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tariff'); ?></dt>
		<dd>
			<?php echo $this->Html->link($bill['Tariff']['id'], array('controller' => 'tariffs', 'action' => 'view', $bill['Tariff']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payed'); ?></dt>
		<dd>
			<?php echo h($bill['Bill']['payed']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Bill'), array('action' => 'edit', $bill['Bill']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Bill'), array('action' => 'delete', $bill['Bill']['id']), array(), __('Are you sure you want to delete # %s?', $bill['Bill']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Bills'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bill'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts'), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account'), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tariffs'), array('controller' => 'tariffs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tariff'), array('controller' => 'tariffs', 'action' => 'add')); ?> </li>
	</ul>
</div>
