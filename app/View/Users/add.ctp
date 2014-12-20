<form id="userAddForm">
    <input type="input" class="form-control" name="data[Account][username]" placeholder="Username">
    <input type="password" class="form-control" name="data[Account][password]" placeholder="Password">

    <select name="data[Account][role]" class="form-control">
        <option value="0" selected="selected">Mitglied</option>
        <?php
        if($user['role'] > 0) {
            echo '<option value="1">Mitarbeiter</option>';
        }
        if($user['role'] == 2) {
            echo '<option value="2">Administrator</option>';
        }
        ?>
    </select>

    <input type="input" class="form-control" name="data[Person][name]" placeholder="Nachname">
    <input type="input" class="form-control" name="data[Person][surname]" placeholder="Vorname">
    <input type="input" class="form-control" name="data[Person][phone]" placeholder="Telefon/Handy">
    <input type="input" class="form-control" name="data[Person][plz]" placeholder="Postleitzahl">
    <input type="input" class="form-control" name="data[Person][city]" placeholder="Stadt">
    <input type="input" class="form-control" name="data[Person][street]" placeholder="Straße">
    <input type="input" class="form-control" name="data[Person][housenumber]" placeholder="Hausnummer">
    <input type="input" class="form-control" name="data[Person][hnextra]" placeholder="Zusatz">


    <div class="input-group input-append date">
        <span class="input-group-addon">
            <i class="glyphicon glyphicon-calendar"></i>
        </span>
        <input type="text" name="data[Person][birthdate]" class="form-control " placeholder="Geburtstag">
    </div>

    <button type="submit" class="btn btn-default">Erstellen</button>
</form>


<?php echo $this->Html->scriptStart(array('inline' => true)); ?>
$(document).ready(function() {
    $('input[name="data[Person][birthdate]"]').datepicker({
        format: 'dd.mm.yyyy',
        language: "de"
    });
    $('#userAddForm').submit(function(event)
    {
        $.post('<?php echo $this->webroot;?>users/add', $('#userAddForm').serialize(), function(json) {
            if(json.success == true)
            {
                notifyUser(json.message, 'success');
            } else {
                alert(json.errors);
                notifyUser(json.message);
                //auswerten der Errors;
            }
        }, 'json');
        event.preventDefault();
    });
});
<?php echo $this->Html->scriptEnd(); ?>