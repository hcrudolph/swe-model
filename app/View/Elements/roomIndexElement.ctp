<?php
$roomId = $room['Room']['id'];
?>

<div class="panel panel-default" id="roomIndexEntry<?php echo $roomId; ?>">
    <div class="panel-heading clearfix" role="tab" id="roomIndexEntryHeading<?php echo $roomId; ?>">
        <h4 class="panel-title pull-left">
            <a data-toggle="collapse" data-parent="#roomEntries" data-url="<?php echo $this->webroot;?>rooms/view/<?php echo $roomId; ?>" href="#roomIndexEntryCollapse<?php echo $roomId;?>" aria-expanded="false" aria-controls="roomIndexEntryCollapse<?php echo $roomId; ?>">
                <?php echo h($room['Room']['name']); ?>
            </a>
        </h4>
        <?php if(isset($user) AND $user['role'] > 0) {?>
            <div class="btn-group pull-right">
                <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="roomEdit(<?php echo $roomId; ?>);">Bearbeiten</a>
                <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="roomDelete(<?php echo $roomId; ?>);">Löschen</a>
            </div>
        <?php } ?>
    </div>
    <div id="roomIndexEntryCollapse<?php echo $roomId;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="roomIndexEntryHeading<?php echo $roomId; ?>">
        <div class="panel-body"></div>
    </div>
</div>