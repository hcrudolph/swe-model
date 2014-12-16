<div id="postEntry<?php echo h($post['Post']['id']); ?>" class="postEntry">
    <p class="bg-primary"><?php echo h($post['Post']['heading']); ?></p>
    <p class="bg-info"><?php echo nl2br(h($post['Post']['body'])); ?></p>
    <p class="bg-success"><?php echo h($post['Account']['username']);?></p>
    <p class="bg-warning"><?php echo date("d.m.Y h:i:s", strtotime($post['Post']['created'])); ?></p>
    <?php if(!empty($user)){?>
    <core-tooltip label="Eintrag löschen" pressed id="core_tooltip">
      <core-icon-button icon="delete" onclick="postEntryDelete(<?php echo h($post['Post']['id']); ?>);" class="delete"></core-icon-button>
    </core-tooltip>
    <core-tooltip label="Eintrag bearbeiten" active pressed id="core_tooltip1">
      <core-icon-button icon="create" onclick="postEntryEdit(<?php echo h($post['Post']['id']); ?>);" class="edit"></core-icon-button>
    </core-tooltip>
    <?php } ?>
</div>