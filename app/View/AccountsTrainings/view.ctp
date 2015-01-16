<div class="accountsTrainings view">
<h2><?php echo __('Accounts Training'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($accountsTraining['AccountsTraining']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Account'); ?></dt>
		<dd>
			<?php echo $this->Html->link($accountsTraining['Account']['username'], array('controller' => 'accounts', 'action' => 'view', $accountsTraining['Account']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Downloadlink'); ?></dt>
		<dd>
			<?php echo h($accountsTraining['AccountsTraining']['downloadlink']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($accountsTraining['AccountsTraining']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Accounts Training'), array('action' => 'edit', $accountsTraining['AccountsTraining']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Accounts Training'), array('action' => 'delete', $accountsTraining['AccountsTraining']['id']), array(), __('Are you sure you want to delete # %s?', $accountsTraining['AccountsTraining']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts Trainings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Accounts Training'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts'), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account'), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
	</ul>
</div>
