<?php
foreach ($courses as $course) {
    ?>
    <div class="row">
        <div class="col-md-3 pull-left">
            <div class="thumbnail">
                <span class="glyphicon glyphicon-picture" style="font-size:150px;" aria-hidden="true"></span>
                <img src="<?php echo $this->webroot; ?>img/Kurse/<?php echo $course['Course']['id'];?>.jpg" style="display:none;">
            </div>
        </div>
        <div class="col-md-9 pull-right">
            <h4 class="media-heading"><?php echo $course['Course']['name']?></h4>
            <?php echo $course['Course']['description'] ?>
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