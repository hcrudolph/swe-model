<div id="postEntry<?php echo h($post['Post']['id']); ?>" class="postEntry">
    <div class="panel panel-info">
        <div class="panel-heading clearfix">
            <?php if(!empty($user)){?>
                <div class="btn-group pull-right" style="position:relative;display:inline;">
                    <a class="btn btn-default btn-sm" href="javascript:void(0)" onclick="postEntryEdit(<?php echo h($post['Post']['id']); ?>);">Bearbeiten</a>
                    <a class="btn btn-default btn-sm" href="javascript:void(0)" onclick="postEntryDelete(<?php echo h($post['Post']['id']); ?>);">Löschen</a>
                </div>
            <?php } ?>
            <h3 class="panel-title pull-left" style="position:relative;display:inline;"><?php echo h($post['Post']['heading']); ?></h3>
        </div>
        <div class="panel-body">
            <?php echo nl2br(h($post['Post']['body'])); ?>
        </div>
        <div class="panel-footer">
            <?php echo h($post['Account']['Person']['surname']);?> <?php echo h($post['Account']['Person']['name']);?>, <?php echo h($post['Post']['created']); ?>
        </div>

    </div>
</div>