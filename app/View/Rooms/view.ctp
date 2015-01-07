<?php
$roomId = $room['Room']['id'];
?>
<div id="roomEntry<?php echo $roomId; ?>" class="row">
    <div class="col-xs-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Raumname</h3>
            </div>
            <div class="panel-body">
                <?php echo h($room['Room']['name']); ?>
            </div>
        </div>
    </div>
</div>
