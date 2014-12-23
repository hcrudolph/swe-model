<?php
$account = $userResult['Account'];
$person = $userResult['Person'];
$accId = $account['id'];
?>
<form id="userEditForm<?php echo $accId; ?>">
    <div class="control-group Account">
        <div class="username">
                <input type="input" class="form-control" name="data[Account][username]" value="<?php echo $account['username']; ?>" placeholder="Username">
        </div>
        <div class="password">
            <input type="password" class="form-control" name="data[Account][password]" placeholder="Passwort">
        </div>
        <div class="passwordRepeat">
            <input type="password" class="form-control" name="data[Account][passwordRepeat]" placeholder="Passwort wiederholen">
        </div>
        <div class="role">
            <fieldset <?php echo ((($user['role'] < $account['role']) OR $user['role']==0)?'disabled':'')?>>
                <select name="data[Account][role]" class="form-control">
                    <option value="0" <?php echo (($account['role']==0)?'selected="selected"':'');?>>Mitglied</option>
                    <option value="1" <?php echo (($account['role']==1)?'selected="selected"':'');?>>Mitarbeiter</option>
                    <option value="2" <?php echo (($account['role']==2)?'selected="selected"':'');?>>Administrator</option>
                </select>
            </fieldset>
        </div>
    </div>
    <div class="control-group Person">
        <div class="email">
            <input type="input" class="form-control" name="data[Person][email]" value="<?php echo $person['email']; ?>" placeholder="Email">
        </div>
        <div class="name">
            <input type="input" class="form-control" name="data[Person][name]" value="<?php echo $person['name']; ?>" placeholder="Nachname">
        </div>
        <div class="surname">
            <input type="input" class="form-control" name="data[Person][surname]" value="<?php echo $person['surname']; ?>" placeholder="Vorname">
        </div>
        <div class="phone">
            <input type="input" class="form-control" name="data[Person][phone]" value="<?php echo $person['phone']; ?>" placeholder="Telefon/Handy">
        </div>
        <div class="plz">
            <input type="input" class="form-control" name="data[Person][plz]" value="<?php echo $person['plz']; ?>" placeholder="PLZ">
        </div>
        <div class="city">
            <input type="input" class="form-control" name="data[Person][city]" value="<?php echo $person['city']; ?>" placeholder="Stadt">
        </div>
        <div class="street">
            <input type="input" class="form-control" name="data[Person][street]" value="<?php echo $person['street']; ?>" placeholder="Straße">
        </div>
        <div class="housenumber">
            <input type="input" class="form-control" name="data[Person][housenumber]" value="<?php echo $person['housenumber']; ?>" placeholder="Hausnummer">
        </div>
        <div class="hnextra">
            <input type="input" class="form-control" name="data[Person][hnextra]" value="<?php echo $person['hnextra']; ?>" placeholder="Zusatz">
        </div>
        <div class="birthdate">
            <div class="input-group input-append date">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-calendar"></i>
                </span>
                <input type="text" name="data[Person][birthdate]" class="form-control "<?php echo (isset($person['birthdate'])?' value="'.$person['birthdate'].'"':'')?>>
            </div>
        </div>
    </div>



    <button type="submit" class="btn btn-default">Speichern</button>
</form>

<?php echo $this->Html->scriptStart(array('inline' => true)); ?>

$(function(){
    $('input[name="data[Person][birthdate]"]').datepicker({
        format: 'dd.mm.yyyy',
        language: "de"
    });
});
$(document).ready(function() {
    $('#userEditForm<?php echo $accId; ?>').submit(function(event) {
    $.post('<?php echo $this->webroot;?>users/edit/<?php echo $accId; ?>', $('#userEditForm<?php echo $accId; ?>').serialize(), function(json) {
        if(json.success == true)
        {
            notificateUser(json.message, 'success');
            $.get('<?php echo $this->webroot;?>users/view/<?php echo $accId; ?>', function(view) {
                $('#userEditForm<?php echo $accId; ?>').replaceWith(view);
            });
        } else {
            notificateUser(json.message);

            //delete old errors
            $('#userEditForm<?php echo $accId; ?>').children().each(function() {
                $(this).children().each(function() {
                    $(this).removeClass('has-error has-feedback');
                    $(this).children('.glyphicon').remove();
                    $(this).children('.control-label').remove();
                });
            })

            for(var controller in json.errors)
            {
                for(var key in json.errors[controller])
                {
                    if(json.errors[controller].hasOwnProperty(key))
                    {
                        notificateUser(json.errors[controller][key]);
                        var ele = $('#userEditForm<?php echo $accId; ?> > .'+controller+' > .'+key);
                        ele.addClass('has-error has-feedback');
                        ele.append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
                        ele.append('<label class="control-label">'+json.errors[controller][key]+'</label>');
                    }
                }
            }

        }
    }, 'json');
    event.preventDefault();
    });
});
<?php echo $this->Html->scriptEnd(); ?>