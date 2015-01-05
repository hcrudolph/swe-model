<?php
$roomCount = sizeof($rooms);
?>
    <div id="room">
        <?php
        if(!empty($room) AND $room['role'] > 0) { ?>
            <button type="button" id="roomAddOpenButton" class="btn btn-default" onclick="roomAddOpen()"><i class="glyphicon glyphicon-plus"></i>Hinzufügen</button>
        <?php } ?>
        <div class="panel-group" id="roomEntries" role="tablist" aria-multiselectable="true">
            <?php
            for($i=0; $i < $roomCount; $i++) {
                $account = $rooms[$i]['Account'];
                $person = $rooms[$i]['Person'];
                $accId = $account['id'];
                ?>

                <div class="panel panel-default" id="roomEntry<?php echo $accId; ?>">
                    <div class="panel-heading clearfix" role="tab" id="roomEntryHeading<?php echo $accId; ?>">
                        <h4 class="panel-title pull-left">
                            <a data-toggle="collapse" data-parent="#roomEntries" data-url="<?php echo $this->webroot;?>rooms/view/<?php echo $accId; ?>" href="#roomEntryCollapse<?php echo $accId;?>" aria-expanded="false" aria-controls="roomEntryCollapse<?php echo $accId; ?>">
                                <?php
                                echo h($account['roomname']).' (';
                                echo h($person['surname']).' ';
                                echo h($person['name']).')';
                                ?>
                            </a>
                        </h4>
                        <div class="btn-group pull-right">
                            <a class="btn btn-default btn-sm" href="javascript:void(0)" onclick="roomEdit('<?php echo $this->webroot;?>rooms/edit/',<?php echo $accId; ?>)">Bearbeiten</a>
                            <a class="btn btn-default btn-sm" href="javascript:void(0)" onclick="roomDelete(<?php echo $accId; ?>);">Löschen</a>
                        </div>
                    </div>
                    <div id="roomEntryCollapse<?php echo $accId;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="roomEntryHeading<?php echo $accId; ?>">
                        <div class="panel-body"></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

<?php echo $this->Html->scriptStart(array('inline' => true));?>
    $('#roomEntries > .panel > .panel-heading > .panel-title a').click(function (e) {
    e.preventDefault();

    var url = $(this).attr("data-url");
    var href = this.hash;
    var pane = $(this);

    // ajax load from data-url
    $(href+' > .panel-body').load(url,function(result){
    pane.tab('show');
    });
    });

    function roomAddOpen()
    {
    $.get('<?php echo $this->webroot."rooms/add/";?>', function( view ) {
    $('body').append(view);
    $('body > .modal').modal('show');
    });
    }

    function roomInformation(accId)
    {
    $('#roomEntryInformation'+accId).load('<?php echo $this->webroot."rooms/view/"?>'+accId);
    $('#roomEntryInformation'+accId).show();
    }

    function roomDelete(accId)
    {
    var del = confirm("room #" + accId + " löschen?");
    if (del == true) {
    $.post('<?php echo $this->webroot."rooms/delete/"?>'+accId,function(json) {
    if(json.success == true)
    {
    notificateroom(json.message, 'success');
    $('#roomEntry'+accId).remove();
    } else
    {
    notificateroom(json.message);
    }
    }, 'json');
    }
    }

    $("#roomEntries").on('roomChanged', function(event) {
    var contentShown = false;
    if($('#roomEntryCollapse'+event.accountId).hasClass('active')) {
    contentShown = true;
    }
    $.get('<?php echo $this->webroot?>rooms/listing/'+event.accountId, function(view) {
    var ele = $(view).find('.panel');
    ele.children(' .panel-heading').children('.panel-title').children('a').click(function (e) {
    e.preventDefault();

    var url = $(this).attr("data-url");
    var href = this.hash;
    var pane = $(this);

    // ajax load from data-url
    $(href+' > .panel-body').load(url,function(result){
    pane.tab('show');
    });
    });
    $('#roomEntry'+event.accountId).replaceWith(ele);

    if(contentShown) {
    $('#roomEntry'+event.accountId+' > .panel-heading > .panel-title  a').trigger("click");
    }
    });
    });




<?php
if($roomCount == 1) {?>
    $('#roomEntries > .panel > .panel-heading > .panel-title a').trigger('click');
<?php } ?>
<?php echo $this->Html->scriptEnd();?>