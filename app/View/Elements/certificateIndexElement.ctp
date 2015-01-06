<?php
$certificateId = $certificate['Certificate']['id'];
?>

<div class="panel panel-default" id="certificateIndexEntry<?php echo $certificateId; ?>">
    <div class="panel-heading clearfix" role="tab" id="certificateIndexEntryHeading<?php echo $certificateId; ?>">
        <h4 class="panel-title pull-left">
            <a data-toggle="collapse" data-parent="#certificateEntries" data-url="<?php echo $this->webroot;?>certificates/view/<?php echo $certificateId; ?>" href="#certificateIndexEntryCollapse<?php echo $certificateId;?>" aria-expanded="false" aria-controls="certificateIndexEntryCollapse<?php echo $certificateId; ?>">
                <?php echo h($certificate['Certificate']['name']); ?>
            </a>
        </h4>
        <?php if(isset($user) AND $user['role'] > 0) {?>
            <div class="btn-group pull-right">
                <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="certificateEdit(<?php echo $certificateId; ?>);">Bearbeiten</a>
                <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="certificateDelete(<?php echo $certificateId; ?>);">Löschen</a>
            </div>
        <?php } ?>
    </div>
    <div id="certificateIndexEntryCollapse<?php echo $certificateId;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="certificateIndexEntryHeading<?php echo $certificateId; ?>">
        <div class="panel-body"></div>
    </div>
</div>