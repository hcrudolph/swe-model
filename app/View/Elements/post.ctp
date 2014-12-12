<div id="postEntry<?php echo h($post['Post']['id']); ?>" class="postEntry">
    <core-item class="heading" label="<?php echo h($post['Post']['heading']); ?>" horizontal center layout></core-item>
    <core-item class="body" label="<?php echo h($post['Post']['body']); ?>" horizontal center layout></core-item>
    <core-item class="user" label="<?php echo h($post['Account']['username']);?>" horizontal center layout></core-item>
    <core-item class="created" label="<?php echo h($post['Post']['created']); ?>" horizontal center layout></core-item>
    <?php if(!empty($user)){?>
    <core-tooltip label="Eintrag löschen" pressed id="core_tooltip">
      <core-icon-button icon="delete" onclick="postEntryDelete(<?php echo h($post['Post']['id']); ?>);" class="delete"></core-icon-button>
    </core-tooltip>
    <core-tooltip label="Eintrag bearbeiten" active pressed id="core_tooltip1">
      <core-icon-button icon="create" onclick="postEntryEdit(<?php echo h($post['Post']['id']); ?>);" class="edit"></core-icon-button>
    </core-tooltip>
    <?php } ?>
</div>