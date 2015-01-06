<?php
$tariffId = $tariff['Tariff']['id'];
?>

<div class="panel panel-default" id="tariffIndexEntry<?php echo $tariffId; ?>">
    <div class="panel-heading clearfix" role="tab" id="tariffIndexEntryHeading<?php echo $tariffId; ?>">
        <h4 class="panel-title pull-left">
            <a data-toggle="collapse" data-parent="#tariffEntries" data-url="<?php echo $this->webroot;?>tariffs/view/<?php echo $tariffId; ?>" href="#tariffIndexEntryCollapse<?php echo $tariffId;?>" aria-expanded="false" aria-controls="tariffIndexEntryCollapse<?php echo $tariffId; ?>">
                <?php echo h($tariff['Tariff']['name']); ?>
            </a>
        </h4>
        <?php if(isset($user) AND $user['role'] > 0) {?>
            <div class="btn-group pull-right">
                <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="tariffEdit(<?php echo $tariffId; ?>);">Bearbeiten</a>
                <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="tariffDelete(<?php echo $tariffId; ?>);">Löschen</a>
            </div>
        <?php } ?>
    </div>
    <div id="tariffIndexEntryCollapse<?php echo $tariffId;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tariffIndexEntryHeading<?php echo $tariffId; ?>">
        <div class="panel-body"></div>
    </div>
</div>