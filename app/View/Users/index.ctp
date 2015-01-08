<div id="usersTabbar" role="tabpanel">
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="usersGeneral"></div>
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
