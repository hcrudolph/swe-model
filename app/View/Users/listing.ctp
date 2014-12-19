<div id="userEntries">
    <?php
    foreach($users as $user)
    {
        $account = $user['Account'];
        $person = $user['Person'];
        $accId = $user['Account']['id'];

        echo '<div id="userEntry'.$accId.'">';
            echo h($account['username']);
            echo '<button type="button" class="btn btn-default" onclick="userEdit('.$accId.')"><i class="glyphicon glyphicon-pencil"></i>Edit</button>';
            echo '<button type="button" class="btn btn-default" onclick="userShowInformation('.$accId.')"><i class="glyphicon glyphicon-info-sign"></i>Informationen</button>';
            echo '<button type="button" class="btn btn-default" onclick="userDelete('.$accId.')"><i class="glyphicon glyphicon-trash"></i>Löschen</button>';
            echo '<div id="userEntryShortInfo'.$accId.'" style="display:none;">Kurzinfo zum Nutzer</div>';
        echo "</div>";
    }
    ?>
</div>

<?php echo $this->Html->scriptStart(array('inline' => true));?>
function userEdit(accId)
{
}

function userShowInformation(accId)
{
    $('#userEntryShortInfo'+accId).toggle();
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