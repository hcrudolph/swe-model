<div class="people form">
<?php echo $this->Form->create('Person'); ?>
	<fieldset>
		<legend><?php echo __('Add Person'); ?></legend>
	<?php
		echo $this->Form->input('account_id');
		echo $this->Form->input('email');
		echo $this->Form->input('name');
		echo $this->Form->input('surname');
		echo $this->Form->input('phone');
		echo $this->Form->input('plz');
		echo $this->Form->input('city');
		echo $this->Form->input('street');
		echo $this->Form->input('housenumber');
		echo $this->Form->input('hnextra');
		echo $this->Form->input('birthdate');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List People'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Accounts'), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account'), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
	</ul>
</div>
