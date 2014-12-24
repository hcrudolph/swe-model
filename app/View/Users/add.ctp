<form id="userAddForm">
    <div class="control-group Account">
        <div class="username">
            <input type="input" class="form-control" name="data[Account][username]" placeholder="Username">
        </div>
        <div class="password">
            <input type="password" class="form-control" name="data[Account][password]" placeholder="Passwort">
        </div>
        <div class="passwordRepeat">
            <input type="password" class="form-control" name="data[Account][passwordRepeat]" placeholder="Passwort wiederholen">
        </div>
        <div class="role">
            <select name="data[Account][role]" class="form-control">
                <option value="0" selected="selected">Mitglied</option>
                <?php echo (($user['role']==2)?'<option value="1">Mitarbeiter</option>':'')?>
                <?php echo (($user['role']==2)?'<option value="2">Administrator</option>':'')?>
            </select>
        </div>
    </div>
    <div class="control-group Person">
        <div class="email">
            <input type="input" class="form-control" name="data[Person][email]" placeholder="Email">
        </div>
        <div class="name">
            <input type="input" class="form-control" name="data[Person][name]" placeholder="Nachname">
        </div>
        <div class="surname">
            <input type="input" class="form-control" name="data[Person][surname]" placeholder="Vorname">
        </div>
        <div class="phone">
            <input type="input" class="form-control" name="data[Person][phone]" placeholder="Telefon/Handy">
        </div>
        <div class="plz">
            <input type="input" class="form-control" name="data[Person][plz]" placeholder="PLZ">
        </div>
        <div class="city">
            <input type="input" class="form-control" name="data[Person][city]" placeholder="Stadt">
        </div>
        <div class="street">
            <input type="input" class="form-control" name="data[Person][street]" placeholder="Straße">
        </div>
        <div class="housenumber">
            <input type="input" class="form-control" name="data[Person][housenumber]" placeholder="Hausnummer">
        </div>
        <div class="hnextra">
            <input type="input" class="form-control" name="data[Person][hnextra]" placeholder="Zusatz">
        </div>
        <div class="birthdate">
            <div class="input-group input-append date">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-calendar"></i>
                </span>
                <input type="text" name="data[Person][birthdate]" class="form-control " placeholder="Geburtsdatum">
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
        $('#userAddForm').submit(function(event) {
            $.post('<?php echo $this->webroot;?>users/add/', $('#userAddForm').serialize(), function(json) {
                if(json.success == true) {
                    notificateUser(json.message, 'success');

                    $.get('<?php echo $this->webroot?>users/listing/', function( data ) {
                        $('#userListing').replaceWith(data);
                    });
                } else {
                    notificateUser(json.message);

                    //delete old errors
                    $('#userAddForm').children().each(function() {
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
                                var ele = $('#userAddForm > .'+controller+' > .'+key);
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