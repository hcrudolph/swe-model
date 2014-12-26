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
<div class="related">
	<h3><?php echo __('Related Tariffs'); ?></h3>
	<?php if (!empty($bill['Tariff'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Amount'); ?></th>
		<th><?php echo __('Term'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($bill['Tariff'] as $tariff): ?>
		<tr>
			<td><?php echo $tariff['id']; ?></td>
			<td><?php echo $tariff['description']; ?></td>
			<td><?php echo $tariff['amount']; ?></td>
			<td><?php echo $tariff['term']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'tariffs', 'action' => 'view', $tariff['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'tariffs', 'action' => 'edit', $tariff['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'tariffs', 'action' => 'delete', $tariff['id']), array(), __('Are you sure you want to delete # %s?', $tariff['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Tariff'), array('controller' => 'tariffs', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
