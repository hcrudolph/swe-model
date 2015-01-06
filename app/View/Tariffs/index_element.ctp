<?php
echo $this->element('tariffIndexElement', array('tariff' =>$tariff));
?>
<?php echo $this->Html->scriptStart(array('inline' => true));?>
    $('#tariffIndexEntry<?php echo $tariff['tariff']['id'];?> > .panel-heading > .panel-title a').click(function (e) {
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