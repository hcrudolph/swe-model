<div id="usersTabbar" role="tabpanel">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#usersGeneral" data-url="<?php echo $this->webroot; ?>Users/listing/<?php echo $user['id']; ?>">Allgemein</a></li>
        <li role="presentation"><a href="#usersTariff" data-url="<?php echo $this->webroot; ?>tariffs/">Tarife</a></li>
        <li role="presentation"><a href="#usersCertificate" data-url="<?php echo $this->webroot; ?>Certificates/index">Zertifikate</a></li>
        <li role="presentation"><a href="#usersTraining" data-url="<?php echo $this->webroot; ?>Users/view">Trainingspläne</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="usersGeneral"></div>
        <div role="tabpanel" class="tab-pane fade" id="usersTariff"></div>
        <div role="tabpanel" class="tab-pane fade" id="usersCertificate"></div>
        <div role="tabpanel" class="tab-pane fade" id="usersTraining"></div>
    </div>
</div>



<?php echo $this->Html->scriptStart(array('inline' => true)); ?>
$('#usersTabbar > .nav-tabs a').click(function (e) {
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
$('#usersTabbar > .tab-content > #usersGeneral').load('<?php echo $this->webroot; ?>Users/listing/<?php echo $user['id']; ?>',function(result){
    $('#usersTabbar > .active a').tab('show');
});

<?php echo $this->Html->scriptEnd(); ?>
