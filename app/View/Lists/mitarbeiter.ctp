<div id="mitarbeiter">
    <div class="row">
    <?php
    $i = 0;
    foreach ($results as $result) {
        $mrname = $result['Person']['name'];
        $mrsurname = $result['Person']['surname'];
        $mremail = $result['Person']['email'];
        $mrid = $result['Person']['account_id'];
        echo ((($i%4)==0)?'</div><div class="row">':'');
        ?>
        <div class="col-xs-3">
            <div class="thumbnail">
                <span class="glyphicon glyphicon-user" style="font-size:150px;" aria-hidden="true"></span>
                <img src="<?php echo $this->webroot; ?>img/Mitarbeiter/<?php echo $mrid;?>.png" style="display:none;height:150px;" />
                <h4><?php echo $mrsurname . "</br>" . $mrname ?></h4>
            </div>
        </div>
    <?php 
        $i++;
    }
    ?>
    </div>
    <?php echo $this->Html->scriptStart(array('inline' => true)); ?>
        $('.thumbnail img').each(function() {
            $(this).load(function() {
                $(this).css('display', 'block');
                $(this).parent().children('.glyphicon').css('display', 'none');
            })
        });
    <?php echo $this->Html->scriptEnd(); ?>
</div>
