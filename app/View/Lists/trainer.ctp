<div id="trainer">
    <?php
    foreach ($results as $result) {
        $trname = $result['Person']['name'];
        $trsurname = $result['Person']['surname'];
        $tremail = $result['Person']['email'];
        $trid = $result['Person']['account_id'];
        $certname = $result['Certificate']['name'];
        $certdesc = $result['Certificate']['description'];
        
        ?>

        <div class="col-xs-3">
            <div class="popoverElement">
                    <span class="popoverContainer">
                        <div class="thumbnail">
                            <img src="<?php echo $this->webroot ?>/img/Mitarbeiter/<?php echo $trid ?>.png"
                                 alt="<?php echo $this->webroot ?>/img/Mitarbeiter/default.png"
                                 onError="this.onerror=null; this.src='<?php echo $this->webroot ?>/img/Mitarbeiter/default.png';"/>
                            <h4><?php echo $trsurname . "</br>" . $trname ?></h4>
                        </div>
                    </span>
                    <span class="popoverContent"
                          style="display:none;"><h4><?php echo $certname.": ".$certdesc
                            ?></h4>
                    </span>
            </div>
        </div>
    <?php }
    ?>
</div>


<?php echo $this->Html->scriptStart(array('inline' => true)); ?>
$('.popoverElement').each(function() {
$(this).popover({
html: true,
container: $(this).children('.popoverContainer'),
trigger: 'hover',
placement: 'bottom',
content: function() {
return $(this).children('.popoverContent').text();
}
});
});
<?php echo $this->Html->scriptEnd(); ?>