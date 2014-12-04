<div class="bills form">
<?php echo $this->Form->create('Bill'); ?>
	<fieldset>
		<legend><?php echo __('Edit Bill'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('account_id');
		echo $this->Form->input('year');
		echo $this->Form->input('month');
		echo $this->Form->input('tariff_id');
		echo $this->Form->input('payed');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Bill.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Bill.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Bills'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Accounts'), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account'), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tariffs'), array('controller' => 'tariffs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tariff'), array('controller' => 'tariffs', 'action' => 'add')); ?> </li>
	</ul>
</div>
