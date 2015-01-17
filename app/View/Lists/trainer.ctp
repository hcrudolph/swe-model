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
                    <table class="table striped">
                        <thead>
                            <tr>
                                <th>Zertifkate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($trainer['Certificate']) > 0) {
                            foreach($trainer['Certificate'] as $certificate) {?>
                            <tr>
                                <td><?php echo $certificate['name'];?></td>
                            </tr>
                            <?php }} else { ?>
                            <tr>
                                <td>Keine Zertifikate</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php if(!empty($user) && (!is_null($tremail))) {?>
                    <table class="table striped">
                        <thead>
                            <tr>
                                <th>E-Mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>a href="mailto:<?php echo $tremail;?>"><?php echo $tremail;?></a></td>
                            </tr>
                        </tbody>
                    </table>
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
        });

    <?php echo $this->Html->scriptEnd(); ?>
</div>
