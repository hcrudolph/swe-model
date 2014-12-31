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
                <a href="#" id="trainerPOP">
                    <img src="<?php echo $this->webroot ?>/img/Mitarbeiter/<?php echo $trid ?>.png"
                         alt="<?php echo $this->webroot ?>/img/Mitarbeiter/default.png"
                         onError="this.onerror=null; this.src='<?php echo $this->webroot ?>/img/Mitarbeiter/default.png';"/>

                    <h3><?php echo $trsurname . "</br>" . $trname ?></h3>
                </a></div>
        </div>
    <?php }
    ?>
</div>

<div id="popContent" style="display: none">
    <h3><?php echo
            /* placeholder for certificates */
            $trsurname . "</br>" . $trname ?>
    </h3>
</div>

<script>
    $(function () {
        $("#trainerPOP").popover({
            placement: 'bottom',
            trigger: 'hover',
            html: true,
            content: function () {
                return $('#popContent').html();
            }
        });
    });
</script>