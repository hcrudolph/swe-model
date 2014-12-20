<div>
    <?php
    echo '<button type="button" class="btn btn-default" onclick="userAdd()"><i class="glyphicon glyphicon-plus"></i>Hinzufügen</button>';
    ?>
</div>
<div id="userEntries">
    <?php
    foreach($usersListing as $userListing)
    {
        $account = $userListing['Account'];
        $person = $userListing['Person'];
        $accId = $account['id'];

        echo '<div id="userEntry'.$accId.'">';
            echo '<div onclick="userInformationToggle('.$accId.')">';
                echo h($account['username']);
            echo '</div>';
            echo '<button type="button" class="btn btn-default" onclick="userEdit('.$accId.')"><i class="glyphicon glyphicon-pencil"></i>Bearbeiten</button>';
            echo '<button type="button" class="btn btn-default" onclick="userInformation('.$accId.')"><i class="glyphicon glyphicon-info-sign"></i>Informationen</button>';
            echo '<button type="button" class="btn btn-default" onclick="userDelete('.$accId.')"><i class="glyphicon glyphicon-trash"></i>Löschen</button>';
            echo '<div id="userEntryInformation'.$accId.'" style="display:none;"></div>';
        echo "</div>";
    }
    ?>
</div>

<?php echo $this->Html->scriptStart(array('inline' => true));?>
function userInformationToggle(accId)
{
    $('#userEntryInformation'+accId).toggle();
}

function userEdit(accId)
{
    $('#userEntryInformation'+accId).load('<?php echo $this->webroot."users/edit/"?>'+accId);
    $('#userEntryInformation'+accId).show();
}

function userAdd()
{
    $('#userEntryInformation').load('<?php echo $this->webroot."users/add/"?>');
    $('#userEntryInformation').show();
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