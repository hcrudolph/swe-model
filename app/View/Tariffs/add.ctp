<div class="tariffs form">
<?php echo $this->Form->create('Tariff'); ?>
	<fieldset>
		<legend><?php echo __('Add Tariff'); ?></legend>
	<?php
		echo $this->Form->input('description');
		echo $this->Form->input('amount');
		echo $this->Form->input('term');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Tariffs'), array('action' => 'index')); ?></li>
	</ul>
</div>
