<div id="trainer">
    <?php
    $trenner = '';
    $i = 0;
    foreach ($trainers as $trainer) {
        $trname = $trainer['Person']['name'];
        $trsurname = $trainer['Person']['surname'];
        $tremail = $trainer['Person']['email'];
        $trid = $trainer['Person']['account_id'];

        if (($i % 4) == 0) {
            echo $trenner;
            $trenner = '</div><div class="row">';
        }
        ?>

        <div class="col-xs-3">
            <div class="popoverElement">
                <div class="thumbnail">
                    <span class="glyphicon glyphicon-user" style="font-size:150px;" aria-hidden="true"></span>
                    <img src="<?php echo $this->webroot; ?>img/Mitarbeiter/<?php echo $trid; ?>.png"
                         style="display:none;height:150px;"/>
                    <h4><?php echo $trsurname . "</br>" . $trname ?></h4>
                </div>
                <span class="popoverContent" style="display:none;">
                    <ul class="list-group">
                        <?php
                        if (count($trainer['Certificate']) > 0) {
                            foreach ($trainer['Certificate'] as $certificate) {
                                echo
                                    '<li class="list-group-item">
                                        <h4 class="list-group-item-heading">' . $certificate['name'] . ':</h4>';
                                echo
                                    '<p class ="list-group-item-text">' . $certificate['description'] . '</p>
                                         </li>';
                            }
                        } else {
                            echo '<li class="list-group-item">Keine Zertifikate</li>';
                        }
                        ?>
                    </ul>
                </span>
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


$('.popoverElement').each(function() {
$(this).popover({
html: true,
container: $(this),
trigger: 'hover',
placement: 'bottom',
content: function() {
return $(this).children('.popoverContent').html();
}
});
});
<?php echo $this->Html->scriptEnd(); ?>
</div>
