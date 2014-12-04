<div class="bills index">
	<h2><?php echo __('Bills'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('account_id'); ?></th>
			<th><?php echo $this->Paginator->sort('year'); ?></th>
			<th><?php echo $this->Paginator->sort('month'); ?></th>
			<th><?php echo $this->Paginator->sort('tariff_id'); ?></th>
			<th><?php echo $this->Paginator->sort('payed'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($bills as $bill): ?>
	<tr>
		<td><?php echo h($bill['Bill']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($bill['Account']['username'], array('controller' => 'accounts', 'action' => 'view', $bill['Account']['id'])); ?>
		</td>
		<td><?php echo h($bill['Bill']['year']); ?>&nbsp;</td>
		<td><?php echo h($bill['Bill']['month']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($bill['Tariff']['id'], array('controller' => 'tariffs', 'action' => 'view', $bill['Tariff']['id'])); ?>
		</td>
		<td><?php echo h($bill['Bill']['payed']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $bill['Bill']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $bill['Bill']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $bill['Bill']['id']), array(), __('Are you sure you want to delete # %s?', $bill['Bill']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Bill'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Accounts'), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account'), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tariffs'), array('controller' => 'tariffs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tariff'), array('controller' => 'tariffs', 'action' => 'add')); ?> </li>
	</ul>
</div>
