<?php
$courseId = $course['Course']['id'];
?>

<div class="panel panel-default" id="courseIndexEntry<?php echo $courseId; ?>">
    <div class="panel-heading clearfix" role="tab" id="courseIndexEntryHeading<?php echo $courseId; ?>">
        <h4 class="panel-title pull-left">
            <a data-toggle="collapse" data-parent="#courseEntries" data-url="<?php echo $this->webroot;?>courses/view/<?php echo $courseId; ?>" href="#courseIndexEntryCollapse<?php echo $courseId;?>" aria-expanded="false" aria-controls="courseIndexEntryCollapse<?php echo $courseId; ?>">
                <?php echo h($course['Course']['name']); ?>
            </a>
        </h4>
        <?php if(isset($user) AND $user['role'] > 0) {?>
            <div class="btn-group pull-right">
                <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="courseEdit(<?php echo $courseId; ?>);">Bearbeiten</a>
                <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="courseDelete(<?php echo $courseId; ?>);">Löschen</a>
            </div>
        <?php } ?>
    </div>
    <div id="courseIndexEntryCollapse<?php echo $courseId;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="courseIndexEntryHeading<?php echo $courseId; ?>">
        <div class="panel-body"></div>
    </div>
</div>