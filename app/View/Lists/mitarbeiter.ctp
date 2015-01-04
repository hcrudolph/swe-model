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
                <span class="glyphicon glyphicon-user" style="font-size: 10em;" aria-hidden="true"></span>
                <img src="<?php echo $this->webroot; ?>img/Mitarbeiter/<?php echo $trid;?>.png" style="display:none;" />
                <h4><?php echo $mrsurname . "</br>" . $mrname ?></h4>
            </div>
        </div>
    <?php }
    ?>
    <?php echo $this->Html->scriptStart(array('inline' => true)); ?>
        $('.thumbnail img').each(function() {
            $(this).load(function() {
                $(this).css('display', 'block');
                $(this).parent().children('.glyphicon').css('display', 'none');
            })
        });
    <?php echo $this->Html->scriptEnd(); ?>
</div>