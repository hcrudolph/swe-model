<?php
echo $this->element('courseIndexElement', array('course' =>$course));
?>
<?php echo $this->Html->scriptStart(array('inline' => true));?>
    $('#courseIndexEntry<?php echo $course['Course']['id'];?> > .panel-heading > .panel-title a').click(function (e) {
    e.preventDefault();

    var url = $(this).attr("data-url");
    var href = this.hash;
    var pane = $(this);

    // ajax load from data-url
    $(href+' > .panel-body').load(url,function(result){
    pane.tab('show');
    });
    });
<?php echo $this->Html->scriptEnd(); ?>