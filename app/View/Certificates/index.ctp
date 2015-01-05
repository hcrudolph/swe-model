<?php /* OLD index view, keep for referencing functionality

<div class="certificates index">
	<h2><?php echo __('Certificates'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($certificates as $certificate): ?>
	<tr>
		<td><?php echo h($certificate['Certificate']['id']); ?>&nbsp;</td>
		<td><?php echo h($certificate['Certificate']['name']); ?>&nbsp;</td>
		<td><?php echo h($certificate['Certificate']['description']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $certificate['Certificate']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $certificate['Certificate']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $certificate['Certificate']['id']), array(), __('Are you sure you want to delete # %s?', $certificate['Certificate']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Certificate'), array('action' => 'add')); ?></li>
	</ul>
</div>

*/ ?>

<div class="actions">
	<button type="button" id="AddNewCert" class="btn btn-default" onclick="AddNewCert()"><i class="glyphicon glyphicon-plus"></i> Certificate</button>
</div>

<div id="certificates index" class="row list-group">
    <?php foreach ($certificates as $certificate): ?>
    <div class="item  col-xs-4">
        <div class="thumbnail">
            <div class="popover-wrapper" id="certificatePOP">
                <div class="caption">
                    <h4 class="group inner list-group-item-heading">
                        <?php echo h($certificate['Certificate']['name']); ?></h4>
						<a class="btn btn-default btn-sm" href="javascript:void(0)" onclick="CertEdit('<?php echo $this->webroot;?>certificates/edit/',<?php echo $certificate['Certificate']['id']; ?>)">Bearbeiten</a>
                   		<a class="btn btn-default btn-sm" href="javascript:void(0)" onclick="CertDelete(<?php echo $this->webroot;?>certificates/delete/',<?php echo $certificate['Certificate']['id']; ?>);">Löschen</a>

                </div>
                </a>

            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div id="popContent" style="display: none">
        <p><?php echo h($certificate['Certificate']['description']); ?></p>
    </div>

    <script>
        $(function () {
            $("#certificatePOP").popover({
                placement: 'bottom',
                trigger: 'hover',
                html: true,
                content: function () {
                    return $('#popContent').html();
                }
            });
        });
    </script>