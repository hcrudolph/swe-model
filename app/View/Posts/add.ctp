<div id="postAdd<?php echo ((isset($appId))?$appId:'');?>">
    <input is="core-input" class="header" placeholder="Betreff">
    <input is="core-input" class="body" multiline placeholder="Body">
    <input is="core-input" class="date" multiline placeholder="Date">
    <date-picker class="date"></date-picker>
    <core-tooltip label="Eintrag speichern" active pressed>
        <core-icon-button icon="save" class="save" onclick="postAddSubmit(<?php echo $addId;?>)"></core-icon-button>
    </core-tooltip>
    <?php echo $this->Html->scriptStart(array('inline' => true)); ?>
    <?php echo $this->Html->scriptEnd(); ?>
</div>

<?php echo $this->Html->scriptStart(array('inline' => true)); ?>
function postAddSubmit(id)
{
    alert('Der Eintrag soll gespeichert werden');
    $.post('<?php echo $this->webroot;?>+posts/add/'+id,
        {
            heading:'asd',
            body: 'asd',
            date: ''
        }, function() {
            
    });
}
<?php echo $this->Html->scriptEnd();?>

<?php /*
<div class="posts form">
<?php echo $this->Form->create('Post'); ?>
	<fieldset>
		<legend><?php echo __('Add Post'); ?></legend>
	<?php
		echo $this->Form->input('account_id');
		echo $this->Form->input('heading');
		echo $this->Form->input('body');
		echo $this->Form->input('visiblebegin');
		echo $this->Form->input('visibleend');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>*/?>
