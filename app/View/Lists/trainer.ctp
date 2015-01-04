<div id="trainer">
    <?php
    foreach ($trainers as $trainer) {
        $trname = $trainer['Person']['name'];
        $trsurname = $trainer['Person']['surname'];
        $tremail = $trainer['Person']['email'];
        $trid = $trainer['Person']['account_id'];
        ?>

        <div class="col-xs-3">
            <div class="popoverElement">
                <div class="thumbnail">
                    <img img-source="<?php echo $this->webroot; ?>img/Mitarbeiter/<?php echo $trid;?>.png"/>
                    <h4><?php echo $trsurname . "</br>" . $trname ?></h4>
                </div>
                <span class="popoverContent" style="display:none;">
                    <ul class="list-group">
                            <?php
                            if(count($trainer['Certificate']) > 0) {
                                foreach ($trainer['Certificate'] as $certificate) {
                                    echo
                                        '<li class="list-group-item"><p>'$certificate['name']'</p>
                                         <p>'$certificate['description']'</p>
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
    <?php }
    ?>
    <?php echo $this->Html->scriptStart(array('inline' => true)); ?>
        $('.thumbnail img').each(function() {
            $(this).error(function() { $(this).attr('src', '<?php echo $this->webroot; ?>img/Mitarbeiter/default.png'); })
            .attr("src", $(this).attr('img-source'))
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