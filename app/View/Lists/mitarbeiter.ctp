<div id="mitarbeiter">
    <?php
    ob_start();
    foreach ($results as $result) {
        $mrname = $result['Person']['name'];
        $mrsurname = $result['Person']['surname'];
        $mremail = $result['Person']['email'];
        $mrid = $result['Person']['account_id'];
        ?>

        <div class="col-xs-3">
            <div class="thumbnail">
                <img src="<?php echo $this->webroot ?>/img/Mitarbeiter/<?php echo $mrid ?>.png"
                     alt="<?php echo $this->webroot ?>/img/Mitarbeiter/default.png"
                     onError="this.onerror=null; this.src='<?php echo $this->webroot ?>/img/Mitarbeiter/default.png';"/>
                <h4><?php echo $mrsurname . "</br>" . $mrname ?></h4>
            </div>
        </div>
    <?php }
    ?>
</div>