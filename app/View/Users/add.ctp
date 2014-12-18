<form id="userAddForm">
    <input type="input" class="form-control" name="data[Account][username]" placeholder="Username">
    <input type="password" class="form-control" name="data[Account][password]" placeholder="Password">

    <select name="data[Account][role]" class="selectpicker">
        <option value="0">Mitglied</option>
        <?php
        if($user('role')>0){
            echo '<option value="1">Mitarbeiter</option>';
            echo '<option value="2">Administrator</option>';
        }
        ?>
    </select>


    <input type="input" class="form-control" name="data[Account][role]" placeholder="Rolle">
    <input type="input" class="form-control" name="data[Person][name]" placeholder="Nachname">
    <input type="input" class="form-control" name="data[Person][surname]" placeholder="Vorname">
    <input type="input" class="form-control" name="data[Person][phone]" placeholder="Telefon/Handy">
    <input type="input" class="form-control" name="data[Person][plz]" placeholder="Postleitzahl">
    <input type="input" class="form-control" name="data[Person][city]" placeholder="Stadt">
    <input type="input" class="form-control" name="data[Person][street]" placeholder="Straße">
    <input type="input" class="form-control" name="data[Person][housenumber]" placeholder="Hausnummer">
    <input type="input" class="form-control" name="data[Person][hnextra]" placeholder="Zusatz">
    <input type="input" class="form-control" name="data[Person][birthdate]" placeholder="Geburtstag">

    <button type="submit" class="btn btn-default" id="loginSubmit">Erstellen</button>
</form>


<?php echo $this->Html->scriptStart(array('inline' => true)); ?>
$(document).ready(function() {
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