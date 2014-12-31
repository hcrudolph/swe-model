<div id="trainer">
    <?php
    foreach ($results as $result) {
        $trname = $result['Person']['name'];
        $trsurname = $result['Person']['surname'];
        $tremail = $result['Person']['email'];
        $trid = $result['Person']['account_id'];
        ?>

        <div class="col-xs-3">
            <div class="thumbnail">
                <img src="<?php echo $this->webroot ?>/img/Mitarbeiter/<?php echo $trid ?>.png"
                     alt="<?php echo $this->webroot ?>/img/Mitarbeiter/default.png"
                     onError="this.onerror=null; this.src='<?php echo $this->webroot ?>/img/Mitarbeiter/default.png';"/>

                <h3><?php echo $trsurname . " " . $trname ?></h3>
            </div>
        </div>
    <?php }
    ?>
</div>


<div class="col-xs-3">
    <div class="thumbnail">
        <a href="#" id="trainerPOP">
            <img src="<?php echo $this->webroot ?>/img/Mitarbeiter/default.png" width="200" height="200">

            <h3>Here goes the name</h3>
        </a></div>
</div>

<script>
    $(function () {
        $("#trainerPOP").popover({
            title: 'Here goes the Trainer name',
            content: "Here goes the additional information e.g. certificates etc..."
        });
    });
</script>