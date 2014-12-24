<div id="userListing">
    <button type="button" id="userAddOpenButton" class="btn btn-default" onclick="userAddOpen()"><i class="glyphicon glyphicon-plus"></i>Hinzufügen</button>
    <button type="button" id="userAddCloseButton" class="btn btn-default" onclick="userAddClose()" style="display:none;"><i class="glyphicon glyphicon-minus"></i>Schließen</button>


    <div class="panel-group" id="userEntries" role="tablist" aria-multiselectable="true">
        <?php
        for($i=0; $i < sizeof($usersListing); $i++) {
            $account = $usersListing[$i]['Account'];
            $person = $usersListing[$i]['Person'];
            $accId = $account['id'];
        ?>

        <div class="panel panel-default" id="userEntry<?php echo $accId; ?>">
            <div class="panel-heading" role="tab" id="userEntryHeading<?php echo $accId; ?>">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#userEntries" data-url="<?php echo $this->webroot;?>Users/view/<?php echo $accId; ?>" href="#userEntryCollapse<?php echo $accId;?>" aria-expanded="false" aria-controls="userEntryCollapse<?php echo $accId; ?>">
                        <?php echo h($account['username']); ?>
                    </a>
                    <button type="button" class="btn btn-default" onclick="userDelete(<?php echo $accId; ?>)"><i class="glyphicon glyphicon-trash"></i> Löschen</button>
                </h4>
            </div>
            <div id="userEntryCollapse<?php echo $accId;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="userEntryHeading<?php echo $accId; ?>">
                <div class="panel-body"></div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<?php echo $this->Html->scriptStart(array('inline' => true));?>
$('#userEntries > .panel > .panel-heading a').click(function (e) {
    e.preventDefault();

    var url = $(this).attr("data-url");
    var href = this.hash;
    var pane = $(this);

    // ajax load from data-url
    $(href+' > .panel-body').load(url,function(result){
        pane.tab('show');
    });
});


function userEdit(accId)
{
    $('#userEntryCollapse'+accId+' > .panel-body').load('<?php echo $this->webroot."users/edit/"?>'+accId);
}

function userEditClose(accId)
{
    $('#userEntryCollapse'+accId+' > .panel-body').load('<?php echo $this->webroot."users/view/"?>'+accId);
}

function userAddOpen()
{
    if($('#userAddForm').length == 0)
    {
        $.get('<?php echo $this->webroot."users/add/";?>', function( data ) {
            $('#userEntries').before(data);
        });
    $('#userAddOpenButton').toggle();
    $('#userAddCloseButton').toggle();
    }

}

function userAddClose()
{
    $('#userAddForm').remove();
    $('#userAddOpenButton').toggle();
    $('#userAddCloseButton').toggle();
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
<?php echo $this->Html->scriptEnd();?>