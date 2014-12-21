<?php
$account = $userResult['Account'];
$person = $userResult['Person'];
$accId = $account['id'];
?>

<form id="userEditForm<?php echo $accId; ?>">
    <input type="input" class="form-control" name="data[Account][username]" value="<?php echo $account['username']; ?>" placeholder="Username">
    <input type="password" class="form-control" name="data[Account][password]" placeholder="Passwort">
    <input type="password" class="form-control" name="data[Account][passwordRepeat]" placeholder="Passwort wiederholen">

    <select name="data[Account][role]" class="form-control">
        <option value="0" <?php echo (($account['role']==0)?'selected="selected"':'');?>>Mitglied</option>
        <option value="1" <?php echo (($account['role']==1)?'selected="selected"':'');?>>Mitarbeiter</option>
        <option value="2" <?php echo (($account['role']==2)?'selected="selected"':'');?>>Administrator</option>
    </select>

    <input type="input" class="form-control" name="data[Person][email]" value="<?php echo $person['email']; ?>" placeholder="Email">
    <input type="input" class="form-control" name="data[Person][name]" value="<?php echo $person['name']; ?>" placeholder="Nachname">
    <input type="input" class="form-control" name="data[Person][surname]" value="<?php echo $person['surname']; ?>" placeholder="Vorname">
    <input type="input" class="form-control" name="data[Person][phone]" value="<?php echo $person['phone']; ?>" placeholder="Telefon/Handy">
    <input type="input" class="form-control" name="data[Person][plz]" value="<?php echo $person['plz']; ?>" placeholder="PLZ">
    <input type="input" class="form-control" name="data[Person][city]" value="<?php echo $person['city']; ?>" placeholder="Stadt">
    <input type="input" class="form-control" name="data[Person][street]" value="<?php echo $person['street']; ?>" placeholder="Straße">
    <input type="input" class="form-control" name="data[Person][housenumber]" value="<?php echo $person['housenumber']; ?>" placeholder="Hausnummer">
    <input type="input" class="form-control" name="data[Person][hnextra]" value="<?php echo $person['hnextra']; ?>" placeholder="Zusatz">


    <div class="input-group input-append date">
        <span class="input-group-addon">
            <i class="glyphicon glyphicon-calendar"></i>
        </span>
        <input type="text" name="data[Person][birthdate]" class="form-control " <?php echo (is_null($person['birthdate'])?'':'value="'.date("d.m.Y", strtotime($person['birthdate'])).'"')?>>
    </div>




    <button type="submit" class="btn btn-default">Speichern</button>
</form>

<?php echo $this->Html->scriptStart(array('inline' => true)); ?>

$(function(){
    $('input[name="data[Person][birthday]"]').datepicker({
        format: 'dd.mm.yyyy',
        language: "de"
    });
});
$(document).ready(function() {
    $('#userEditForm<?php echo $accId; ?>').submit(function(event)
    {
    $.post('<?php echo $this->webroot;?>users/edit/<?php echo $accId; ?>', $('#userEditForm<?php echo $accId; ?>').serialize(), function(json) {
        if(json.success == true)
        {
            notificateUser(json.message, 'success');
        } else {
            //alert(json.errors);
            notificateUser(json.message);
            //auswerten der Errors;
        }
    }, 'json');
    event.preventDefault();
    });
});
<?php echo $this->Html->scriptEnd(); ?>