<?php
$userCount = sizeof($usersListing);
?>
<div id="userListing">
    <?php
    if(!empty($user) AND $user['role'] > 0) { ?>
    <button type="button" id="userAddOpenButton" class="btn btn-default" onclick="userAddOpen()"><i class="glyphicon glyphicon-plus"></i>Hinzufügen</button>
    <?php } ?>
    <div class="panel-group" id="userEntries" role="tablist" aria-multiselectable="true">
        <?php
        for($i=0; $i < $userCount; $i++) {
            $account = $usersListing[$i]['Account'];
            $person = $usersListing[$i]['Person'];
            $accId = $account['id'];
        ?>

        <div class="panel panel-default" id="userEntry<?php echo $accId; ?>">
            <div class="panel-heading clearfix" role="tab" id="userEntryHeading<?php echo $accId; ?>">
                <h4 class="panel-title pull-left">
                    <a data-toggle="collapse" data-parent="#userEntries" data-url="<?php echo $this->webroot;?>Users/view/<?php echo $accId; ?>" href="#userEntryCollapse<?php echo $accId;?>" aria-expanded="false" aria-controls="userEntryCollapse<?php echo $accId; ?>">
                        <?php
                        echo h($account['username']).' (';
                        echo h($person['surname']).' ';
                        echo h($person['name']).')';
                        ?>
                    </a>
                </h4>
                <div class="btn-group pull-right">
                    <a class="btn btn-default btn-sm" href="javascript:void(0)" onclick="userEdit('<?php echo $this->webroot;?>users/edit/',<?php echo $accId; ?>)">Bearbeiten</a>
                    <a class="btn btn-default btn-sm" href="javascript:void(0)" onclick="userDelete(<?php echo $accId; ?>);">Löschen</a>
                </div>
            </div>
            <div id="userEntryCollapse<?php echo $accId;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="userEntryHeading<?php echo $accId; ?>">
                <div class="panel-body"></div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<?php echo $this->Html->scriptStart(array('inline' => true));?>
    $('#userEntries > .panel > .panel-heading > .panel-title a').click(function (e) {
        e.preventDefault();

        var url = $(this).attr("data-url");
        var href = this.hash;
        var pane = $(this);

        // ajax load from data-url
        $(href+' > .panel-body').load(url,function(result){
            pane.tab('show');
        });
    });

function userAddOpen()
{
    $.get('<?php echo $this->webroot."users/add/";?>', function( view ) {
        $('body').append(view);
        $('body > .modal').modal('show');
    });
}

function userInformation(accId)
{
    $('#userEntryInformation'+accId).load('<?php echo $this->webroot."users/view/"?>'+accId);
    $('#userEntryInformation'+accId).show();
}

function userDelete(accId)
{
    var del = confirm("User #" + accId + " löschen?");
    if (del == true) {
    $.post('<?php echo $this->webroot."users/delete/"?>'+accId,function(json) {
        if(json.success == true)
        {
            notificateUser(json.message, 'success');
            $('#userEntry'+accId).remove();
        } else
        {
            notificateUser(json.message);
        }
    }, 'json');
    }
}

    $("#userEntries").on('userChanged', function(event) {
        var contentShown = false;
        if($('#userEntryCollapse'+event.accountId).hasClass('active')) {
            contentShown = true;
        }
        $.get('<?php echo $this->webroot?>Users/listing/'+event.accountId, function(view) {
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
            $('#userEntry'+event.accountId).replaceWith(ele);

            if(contentShown) {
                $('#userEntry'+event.accountId+' > .panel-heading > .panel-title  a').trigger("click");
            }
        });
    });




<?php
if($userCount == 1) {?>
    $('#userEntries > .panel > .panel-heading > .panel-title a').trigger('click');
<?php } ?>
<?php echo $this->Html->scriptEnd();?>