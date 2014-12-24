<div id="postEntry<?php echo h($post['Post']['id']); ?>" class="postEntry">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title" style="display:inline;"><?php echo h($post['Post']['heading']); ?></h3>
            <?php if(!empty($user)){?>
                <div style="display:inline; right:0px;">
                    <button type="button" class="btn btn-default" onclick="postEntryEdit(<?php echo h($post['Post']['id']); ?>);"><i class="glyphicon glyphicon-pencil"></i>Bearbeiten</button>
                    <button type="button" class="btn btn-default" onclick="postEntryDelete(<?php echo h($post['Post']['id']); ?>);"><i class="glyphicon glyphicon-trash"></i>Löschen</button>
                </div>
            <?php } ?>
        </div>
        <div class="panel-body">
            <?php echo nl2br(h($post['Post']['body'])); ?>

        </div>
        <div class="panel-footer">
            <?php echo h($post['Account']['Person']['surname']);?> <?php echo h($post['Account']['Person']['name']);?>, <?php echo h($post['Post']['created']); ?>
        </div>

    </div>
</div>