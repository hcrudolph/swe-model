<div id="listsTabbar" role="tabpanel">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#studioTrainer" data-url="<?php echo $this->webroot;?>Lists/trainer/">Trainer</a></li>
        <li role="presentation"><a href="#studioMitarbeiter" data-url="<?php echo $this->webroot;?>Lists/mitarbeiter/">Mitarbeiter</a></li>
        <li role="presentation"><a href="#studioMitglieder" data-url="<?php echo $this->webroot;?>Lists/mitglieder/">Mitglieder</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="studioTrainer"></div>
        <div role="tabpanel" class="tab-pane fade" id="studioMitarbeiter"></div>
        <div role="tabpanel" class="tab-pane fade" id="studioMitglieder"></div>
    </div>
</div>



<?php echo $this->Html->scriptStart(array('inline' => true)); ?>
$('#listsTabbar > .nav-tabs a').click(function (e) {
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
$('#listsTabbar > .tab-content > #studioTrainer').load('<?php echo $this->webroot;?>Lists/trainer/',function(result){
    $('#listsTabbar > .active a').tab('show');
});
<?php echo $this->Html->scriptEnd(); ?>