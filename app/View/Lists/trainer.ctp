<div id="trainer">
    <?php
    ob_start();
    foreach ($results as $result) {
        $trname = $result['Person']['name'];
        $trsurname = $result['Person']['surname'];
        $tremail = $result['Person']['email'];
        $trid = $result['Person']['account_id'];
        ?>

        <div class="col-xs-3">
            <div class="thumbnail">
                <img src="<?php echo $this->webroot ?>/img/Mitarbeiter/<?php echo $trid ?>.png" alt="<?php echo $this->webroot ?>/img/Mitarbeiter/default.png" onError="this.onerror=null; this.src='<?php echo $this->webroot ?>/img/Mitarbeiter/default.png';" />
                <h3><?php echo $trsurname . " " . $trname ?></h3>
            </div>
        </div>
    <?php }
    ob_end_flush();
    ?>
</div>