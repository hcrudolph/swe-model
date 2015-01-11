<div class="btn-group-vertical">
    <div>
    <span class="btn-group-vertical">
    <label class="control-label">Monat</label>
    <div class="dropdown">
        <button class="btn btn-default dropdown" type="button" id="dropdownMenuMonat" data-toggle="dropdown" aria-expanded="true">Monat
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenuMonat">
            <li role="presentation"><a role="menuitem">Januar</a></li>
            <li role="presentation"><a role="menuitem">Februar</a></li>
            <li role="presentation"><a role="menuitem">März</a></li>
            <li role="presentation"><a role="menuitem">April</a></li>
            <li role="presentation"><a role="menuitem">Mai</a></li>
            <li role="presentation"><a role="menuitem">Juni</a></li>
            <li role="presentation"><a role="menuitem">Juli</a></li>
            <li role="presentation"><a role="menuitem">August</a></li>
            <li role="presentation"><a role="menuitem">September</a></li>
            <li role="presentation"><a role="menuitem">Oktober</a></li>
            <li role="presentation"><a role="menuitem">November</a></li>
            <li role="presentation"><a role="menuitem">Dezember</a></li>
        </ul>
    </div>
        </span>
    <span class="btn-group-vertical">
    <label class="control-label">Jahr</label>
    <div class="dropdown">
        <button class="btn btn-default dropdown" type="button" id="dropdownMenuJahr" data-toggle="dropdown" aria-expanded="true">Jahr
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenuJahr">
            <?php
            for($i=2014; $i < 2021; $i++) {
            ?>
            <li role="presentation"><a role="menuitem"><?php echo $i ?></a></li>
            <?php } ?>
        </ul>
    </div>
        </span>
    </div>
    <br>

<div class="btn-group-vertical" role="group" aria-label="...">
<div id="row" aria-multiselectable="true">
    <?php
    for($i=1; $i < 11; $i++) {
    ?>

        <div id="user-group">
            <label class="btn btn-primary active" data-toggle="buttons">
                <input type="checkbox" autocomplete="off" checked> User<?php echo $i?>
            </label>
        </div>
    <?php } ?>
</div>
</div>
    <br>
    <br>
<div><button type="button" class="btn btn-default">Rechnung erstellen</button></div>
</div>














<?php
/*
<div class="bills index">
	<h2><?php echo __('Bills'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('account_id'); ?></th>
			<th><?php echo $this->Paginator->sort('year'); ?></th>
			<th><?php echo $this->Paginator->sort('month'); ?></th>
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
*/
?>