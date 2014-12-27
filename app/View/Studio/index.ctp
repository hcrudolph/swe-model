<div id="studioTabbar" role="tabpanel">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#studioAccounts" data-url="<?php echo $this->webroot; ?>Users/listing/">Accounts</a></li>
        <li role="presentation"><a href="#studioCourses" data-url="<?php echo $this->webroot;?>Courses/listing/">Kurse</a></li>
        <li role="presentation"><a href="#studioTariffs" data-url="<?php echo $this->webroot; ?>Tariffs/listing/">Tarife</a></li>
        <li role="presentation"><a href="#studioCertificates" data-url="<?php echo $this->webroot; ?>Certificates/listing/">Zertifikate</a></li>
        <li role="presentation"><a href="#studioRechnungsdaten" data-url="<?php echo $this->webroot;?>bills/index/">Rechnungsdaten</a></li>
        <li role="presentation"><a href="#studioAbrechnungsdaten" data-url="<?php echo $this->webroot; ?>bills/index/">Abrechnungsdaten</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="studioAccounts"></div>
        <div role="tabpanel" class="tab-pane fade" id="studioCourses"></div>
        <div role="tabpanel" class="tab-pane fade" id="studioTariffs"></div>
        <div role="tabpanel" class="tab-pane fade" id="studioCertificates"></div>
        <div role="tabpanel" class="tab-pane fade" id="studioRechnungsdaten"></div>
        <div role="tabpanel" class="tab-pane fade" id="studioAbrechnungsdaten"></div>
    </div>
</div>



<?php echo $this->Html->scriptStart(array('inline' => true)); ?>
$('#studioTabbar > .nav-tabs a').click(function (e) {
    e.preventDefault();

    var url = $(this).attr("data-url");
    var href = this.hash;
    var pane = $(this);

    // ajax load from data-url
    $(href).load(url,function(result){
        pane.tab('show');
    });
});

// Content für angezeigten Tab
$('#studioTabbar > .tab-content > #studioAccounts').load('<?php echo $this->webroot; ?>Users/listing',function(result){
    $('#studioTabbar > .active a').tab('show');
});
<?php echo $this->Html->scriptEnd(); ?>