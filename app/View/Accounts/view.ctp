<div class="accounts view">
<h2><?php echo __('Account'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($account['Account']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($account['Account']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($account['Account']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo h($account['Account']['role']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($account['Account']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Account'), array('action' => 'edit', $account['Account']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Account'), array('action' => 'delete', $account['Account']['id']), array(), __('Are you sure you want to delete # %s?', $account['Account']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List People'), array('controller' => 'people', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Person'), array('controller' => 'people', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bills'), array('controller' => 'bills', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bill'), array('controller' => 'bills', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Posts'), array('controller' => 'posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post'), array('controller' => 'posts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Certificates'), array('controller' => 'certificates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Certificate'), array('controller' => 'certificates', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Dates'), array('controller' => 'dates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Date'), array('controller' => 'dates', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php echo __('Related People'); ?></h3>
	<?php if (!empty($account['Person'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $account['Person']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Account Id'); ?></dt>
		<dd>
	<?php echo $account['Person']['account_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
	<?php echo $account['Person']['email']; ?>
&nbsp;</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
	<?php echo $account['Person']['name']; ?>
&nbsp;</dd>
		<dt><?php echo __('Surname'); ?></dt>
		<dd>
	<?php echo $account['Person']['surname']; ?>
&nbsp;</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
	<?php echo $account['Person']['phone']; ?>
&nbsp;</dd>
		<dt><?php echo __('Plz'); ?></dt>
		<dd>
	<?php echo $account['Person']['plz']; ?>
&nbsp;</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
	<?php echo $account['Person']['city']; ?>
&nbsp;</dd>
		<dt><?php echo __('Street'); ?></dt>
		<dd>
	<?php echo $account['Person']['street']; ?>
&nbsp;</dd>
		<dt><?php echo __('Housenumber'); ?></dt>
		<dd>
	<?php echo $account['Person']['housenumber']; ?>
&nbsp;</dd>
		<dt><?php echo __('Hnextra'); ?></dt>
		<dd>
	<?php echo $account['Person']['hnextra']; ?>
&nbsp;</dd>
		<dt><?php echo __('Birthdate'); ?></dt>
		<dd>
	<?php echo $account['Person']['birthdate']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Person'), array('controller' => 'people', 'action' => 'edit', $account['Person']['id'])); ?></li>
			</ul>
		</div>
	</div>
	<div class="related">
	<h3><?php echo __('Related Bills'); ?></h3>
	<?php if (!empty($account['Bill'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Account Id'); ?></th>
		<th><?php echo __('Year'); ?></th>
		<th><?php echo __('Month'); ?></th>
		<th><?php echo __('Tariff Id'); ?></th>
		<th><?php echo __('Payed'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($account['Bill'] as $bill): ?>
		<tr>
			<td><?php echo $bill['id']; ?></td>
			<td><?php echo $bill['account_id']; ?></td>
			<td><?php echo $bill['year']; ?></td>
			<td><?php echo $bill['month']; ?></td>
			<td><?php echo $bill['tariff_id']; ?></td>
			<td><?php echo $bill['payed']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'bills', 'action' => 'view', $bill['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'bills', 'action' => 'edit', $bill['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'bills', 'action' => 'delete', $bill['id']), array(), __('Are you sure you want to delete # %s?', $bill['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Bill'), array('controller' => 'bills', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Posts'); ?></h3>
	<?php if (!empty($account['Post'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Account Id'); ?></th>
		<th><?php echo __('Heading'); ?></th>
		<th><?php echo __('Body'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Visiblebegin'); ?></th>
		<th><?php echo __('Visibleend'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($account['Post'] as $post): ?>
		<tr>
			<td><?php echo $post['id']; ?></td>
			<td><?php echo $post['account_id']; ?></td>
			<td><?php echo $post['heading']; ?></td>
			<td><?php echo $post['body']; ?></td>
			<td><?php echo $post['created']; ?></td>
			<td><?php echo $post['visiblebegin']; ?></td>
			<td><?php echo $post['visibleend']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'posts', 'action' => 'view', $post['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'posts', 'action' => 'edit', $post['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'posts', 'action' => 'delete', $post['id']), array(), __('Are you sure you want to delete # %s?', $post['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Post'), array('controller' => 'posts', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Certificates'); ?></h3>
	<?php if (!empty($account['Certificate'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($account['Certificate'] as $certificate): ?>
		<tr>
			<td><?php echo $certificate['id']; ?></td>
			<td><?php echo $certificate['name']; ?></td>
			<td><?php echo $certificate['description']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'certificates', 'action' => 'view', $certificate['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'certificates', 'action' => 'edit', $certificate['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'certificates', 'action' => 'delete', $certificate['id']), array(), __('Are you sure you want to delete # %s?', $certificate['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Certificate'), array('controller' => 'certificates', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Dates'); ?></h3>
	<?php if (!empty($account['Date'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Course Id'); ?></th>
		<th><?php echo __('Room Id'); ?></th>
		<th><?php echo __('Director'); ?></th>
		<th><?php echo __('Begin'); ?></th>
		<th><?php echo __('End'); ?></th>
		<th><?php echo __('Presetup'); ?></th>
		<th><?php echo __('Postsetup'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($account['Date'] as $date): ?>
		<tr>
			<td><?php echo $date['id']; ?></td>
			<td><?php echo $date['course_id']; ?></td>
			<td><?php echo $date['room_id']; ?></td>
			<td><?php echo $date['director']; ?></td>
			<td><?php echo $date['begin']; ?></td>
			<td><?php echo $date['end']; ?></td>
			<td><?php echo $date['presetup']; ?></td>
			<td><?php echo $date['postsetup']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'dates', 'action' => 'view', $date['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'dates', 'action' => 'edit', $date['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'dates', 'action' => 'delete', $date['id']), array(), __('Are you sure you want to delete # %s?', $date['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Date'), array('controller' => 'dates', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
