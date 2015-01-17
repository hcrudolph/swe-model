<div id="trainer">
    <div class="row">
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
            <a href="javascript:void(0)" class="thumbnail" style="text-decoration: none;color:inherit;">
                <span class="popoverContent" style="display:none;">
                   <h3>Zertifkate</h3>
                    <ul class="list-group">
                        <?php
                        if (count($trainer['Certificate']) > 0) {
                            foreach ($trainer['Certificate'] as $certificate) {?>
                                <li class="list-group-item">
                                    <h4 class="list-group-item-heading"><?php echo $certificate['name'];?></h4>
                                    <span class="popoverContentInfo" style="display:none;">
                                        <?php echo $certificate['description'];?>
                                    </span>
                                </li>
                            <?php
                            }
                        } else {
                            echo '<li class="list-group-item">Keine Zertifikate</li>';
                        }
                        ?>
                    </ul>
                    <?php if(!empty($user)){?>
                    <h3>E-Mail</h3>
                    <ul class="list-group">
                    <?php if ($tremail != null) {?>
                                <li class="list-group-item">
                                    <span class="popoverContentInfo" style="display:block;">
                                        <?php echo $tremail;?>
                                    </span>
                                </li>
                                <?php } else {
                                echo '<li class="list-group-item">Keine E-Mail Adresse</li>';
                                }?>
                    </ul>
                    <?php }?>
                </span>
                <span class="glyphicon glyphicon-user" style="font-size: 150px; display: block;" aria-hidden="true"></span>
                <img src="<?php echo $this->webroot; ?>img/Mitarbeiter/<?php echo $trid; ?>.png" style="display:none;height:150px;"/>
                <h4><?php echo $trsurname . "</br>" . $trname ?></h4>
            </a>
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


        $('#trainer').find('.thumbnail').each(function() {
            $(this).popover({
                html: true,
                container: $(this),
                trigger: 'hover',
                placement: 'left',
                content: function() {
                    return $(this).children('.popoverContent').html();
                }
            });
            $(this).children('.popoverContent').children('.list-group').children('.list-group-item').popover({
                html: true,
                container: $(this),
                trigger: 'hover',
                placement: 'right',
                content: function() {
                    return $(this).children('.popoverContentInfo').html();
                }
            });
        });

    <?php echo $this->Html->scriptEnd(); ?>
</div>
