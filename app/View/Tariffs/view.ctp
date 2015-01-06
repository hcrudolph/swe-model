<?php
$tariffId = $tariff['tariff']['id'];
?>
<div id="tariffEntry<?php echo $tariffId; ?>" class="row">
    <div class="col-xs-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Tarifname</h3>
            </div>
            <div class="panel-body">
                <?php echo h($tariff['tariff']['name']); ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Tarifbeschreibung</h3>
            </div>
            <div class="panel-body">
                <?php echo nl2br(h($tariff['tariff']['description'])); ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Betrag</h3>
            </div>
            <div class="panel-body">
                <?php echo nl2br(h($tariff['tariff']['amount'])); ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Lufzeit in Monaten</h3>
            </div>
            <div class="panel-body">
                <?php echo nl2br(h($tariff['tariff']['term'])); ?>
            </div>
        </div>
    </div>
</div>
