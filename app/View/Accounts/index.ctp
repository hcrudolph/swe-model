<?php
foreach ($accounts as $account) {
?>
<div>
    <span><?php echo h($account['Account']['username']); ?></span>
    <span onclick="editUser(<?php echo h($account['Account']['id']); ?>)">edit</span>
    <span onclick="viewUser(<?php echo h($account['Account']['id']); ?>)">view</span>
    <span onclick="deleteUser(<?php echo h($account['Account']['id']); ?>)">delete</span>
</div>
<?php } ?>

<?php echo $this->Html->scriptStart(array('inline' => true)); ?>
    function editUser(accountId)
    {
        $('#studioTabPageAccount').load('<?php echo $this->webroot."Accounts/edit/"?>'+accountId);
    }
<?php echo $this->Html->scriptEnd();?>

<?php echo $this->Html->scriptStart(array('inline' => true)); ?>
function viewUser(accountId)
{
$('#studioTabPageAccount').load('<?php echo $this->webroot."Accounts/view/"?>'+accountId);
}
<?php echo $this->Html->scriptEnd();?>

<?php echo $this->Html->scriptStart(array('inline' => true)); ?>
function deleteUser(accountId)
{
$('#studioTabPageAccount').load('<?php echo $this->webroot."Accounts/delete/"?>'+accountId);
}
<?php echo $this->Html->scriptEnd();?>

<div class="accounts index">
	<h2><?php echo __('Accounts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th><?php echo $this->Paginator->sort('role'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($accounts as $account): ?>
	<tr>
		<td><?php echo h($account['Account']['id']); ?>&nbsp;</td>
		<td><?php echo h($account['Account']['username']); ?>&nbsp;</td>
		<td><?php echo h($account['Account']['role']); ?>&nbsp;</td>
		<td><?php echo h($account['Account']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $account['Account']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $account['Account']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $account['Account']['id']), array(), __('Are you sure you want to delete # %s?', $account['Account']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Account'), array('action' => 'add')); ?></li>
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
