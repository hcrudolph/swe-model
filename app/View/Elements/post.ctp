<div id="postEntry<?php echo h($post['Post']['id']); ?>" class="postEntry">
    <p class="bg-primary"><?php echo h($post['Post']['heading']); ?></p>
    <p class="bg-info"><?php echo nl2br(h($post['Post']['body'])); ?></p>
    <p class="bg-success"><?php echo h($post['Account']['username']);?></p>
    <p class="bg-warning"><?php echo h($post['Post']['created']); ?></p>
    <?php if(!empty($user)){?>
        <button type="button" class="btn btn-default" onclick="postEntryEdit(<?php echo h($post['Post']['id']); ?>);"><i class="glyphicon glyphicon-pencil"></i>Bearbeiten</button>
        <button type="button" class="btn btn-default" onclick="postEntryDelete(<?php echo h($post['Post']['id']); ?>);"><i class="glyphicon glyphicon-trash"></i>Löschen</button>
    <?php } ?>
</div>