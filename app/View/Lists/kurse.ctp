<?php
foreach ($courses as $course) {
    ?>
    <div class="row">
        <div class="col-md-3 pull-left">
            <div class="thumbnail">
                <img src="<?php echo $this->webroot; ?>img/Kurse/<?php echo $course['Course']['id'];?>.jpg">
            </div>
        </div>
        <div class="col-md-9 pull-right">
            <h4 class="media-heading"><?php echo $course['Course']['name']?></h4>
            <?php echo $course['Course']['description'] ?>
        </div>
    </div>
<?php }
?>