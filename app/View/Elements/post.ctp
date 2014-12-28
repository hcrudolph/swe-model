<div id="postEntry<?php echo h($post['Post']['id']); ?>" class="postEntry">
    <div class="panel panel-info">
        <div class="panel-heading clearfix">
            <h4 class="panel-title pull-left"><?php echo h($post['Post']['heading']); ?></h4>
            <?php if(!empty($user)){?>
                <div class="btn-group pull-right">
                    <a class="btn btn-default btn-sm" href="javascript:void(0)" onclick="postEntryEdit(<?php echo h($post['Post']['id']); ?>);">Bearbeiten</a>
                    <a class="btn btn-default btn-sm" href="javascript:void(0)" onclick="postEntryDelete(<?php echo h($post['Post']['id']); ?>);">Löschen</a>
                </div>
            <?php } ?>
        </div>
        <div class="panel-body">
            <?php echo nl2br(h($post['Post']['body'])); ?>
        </div>
        <div class="panel-footer">
            <?php echo h($post['Account']['Person']['surname']);?> <?php echo h($post['Account']['Person']['name']);?>, <?php echo h($post['Post']['modified']); ?>
        </div>

    </div>
</div>