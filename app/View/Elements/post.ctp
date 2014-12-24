<div id="postEntry<?php echo h($post['Post']['id']); ?>" class="postEntry">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title" style="display:inline;"><?php echo h($post['Post']['heading']); ?></h3>
            <?php if(!empty($user)){?>
                <div class="btn-group">
                    <button type="button" class="btn btn-default" onclick="postEntryEdit(<?php echo h($post['Post']['id']); ?>);">Bearbeiten</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="javascript:void(0)" onclick="postEntryEdit(<?php echo h($post['Post']['id']); ?>);">Bearbeiten</a></li>
                        <li><a href="javascript:void(0)" onclick="postEntryDelete(<?php echo h($post['Post']['id']); ?>);">Löschen</a></li>
                    </ul>
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