<div class="accountsTrainings form">
<?php echo $this->Form->create('AccountsTraining'); ?>
	<fieldset>
		<legend><?php echo __('Add Accounts Training'); ?></legend>
	<?php
		echo $this->Form->input('account_id');
		echo $this->Form->input('downloadlink');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Accounts Trainings'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Accounts'), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account'), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
	</ul>
</div>
