<?php
$account = $userResult['Account'];
$person = $userResult['Person'];
$accId = $account['id'];
?>
<div class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nutzer bearbeiten</h4>
            </div>
            <div class="modal-body">
                <form id="userEditForm">
                    <div class="control-group Account row">
                        <div class="col-xs-6">
                            <div class="panel panel-default username">
                                <div class="panel-heading">Username</div>
                                <input type="input" class="form-control" name="data[Account][username]" value="<?php echo $account['username']; ?>" <?php echo (($user['role'] < $account['role'])?'disabled':'')?> placeholder="Username">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default role">
                                <div class="panel-heading">Rolle des Nutzers</div>
                                <fieldset <?php echo ((($user['role'] < $account['role']) OR $user['role']<2)?'disabled':'')?>>
                                    <select name="data[Account][role]" class="form-control panel-body" style="padding:0px;">
                                        <option value="0" <?php echo (($account['role']==0)?'selected="selected"':'');?>>Mitglied</option>
                                        <option value="1" <?php echo (($account['role']==1)?'selected="selected"':'');?>>Mitarbeiter</option>
                                        <option value="2" <?php echo (($account['role']==2)?'selected="selected"':'');?>>Administrator</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default password">
                                <div class="panel-heading">Passwort</div>
                                <input type="password" class="form-control panel-body" name="data[Account][password]" <?php echo (($user['role'] < $account['role'])?'disabled':'')?> placeholder="Passwort">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default passwordRepeat">
                                <div class="panel-heading">Passwort wiederholen</div>
                                <input type="password" class="form-control panel-body" name="data[Account][passwordRepeat]" <?php echo (($user['role'] < $account['role'])?'disabled':'')?> placeholder="Passwort wiederholen">
                            </div>
                        </div>
                    </div>
                    <div class="control-group Person row">
                        <div class="col-xs-6">
                            <div class="panel panel-default email">
                                <div class="panel-heading">Email</div>
                                <input type="input" class="form-control panel-body" name="data[Person][email]" value="<?php echo $person['email']; ?>" <?php echo (($user['role'] < $account['role'])?'disabled':'')?> placeholder="Email">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default name">
                                <div class="panel-heading">Nachname</div>
                                <input type="input" class="form-control panel-body" name="data[Person][name]" value="<?php echo $person['name']; ?>" <?php echo ((($user['role'] < $account['role']) OR $user['role']== 0)?'disabled':'')?> placeholder="Nachname">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default surname">
                                <div class="panel-heading">Vorname</div>
                                <input type="input" class="form-control panel-body" name="data[Person][surname]" value="<?php echo $person['surname']; ?>" <?php echo ((($user['role'] < $account['role']) OR $user['role']== 0)?'disabled':'')?> placeholder="Vorname">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default phone">
                                <div class="panel-heading">Telefon/Handy</div>
                                <input type="input" class="form-control panel-body" name="data[Person][phone]" value="<?php echo $person['phone']; ?>" <?php echo ((($user['role'] < $account['role']) OR $user['role']== 0)?'disabled':'')?> placeholder="Telefon/Handy">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default plz">
                                <div class="panel-heading">Postleitzahl</div>
                                <input type="input" class="form-control panel-body" name="data[Person][plz]" value="<?php echo $person['plz']; ?>" <?php echo ((($user['role'] < $account['role']) OR $user['role']== 0)?'disabled':'')?> placeholder="PLZ">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default city">
                                <div class="panel-heading">Stadt</div>
                                <input type="input" class="form-control panel-body" name="data[Person][city]" value="<?php echo $person['city']; ?>" <?php echo ((($user['role'] < $account['role']) OR $user['role']== 0)?'disabled':'')?> placeholder="Stadt">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default street">
                                <div class="panel-heading">Straße</div>
                                <input type="input" class="form-control panel-body" name="data[Person][street]" value="<?php echo $person['street']; ?>" <?php echo ((($user['role'] < $account['role']) OR $user['role']== 0)?'disabled':'')?> placeholder="Straße">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default housenumber">
                                <div class="panel-heading">Hausnummer</div>
                                <input type="input" class="form-control panel-body" name="data[Person][housenumber]" value="<?php echo $person['housenumber']; ?>" <?php echo ((($user['role'] < $account['role']) OR $user['role']== 0)?'disabled':'')?> placeholder="Hausnummer">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default hnextra">
                                <div class="panel-heading">Hausnummerzusatz</div>
                                <input type="input" class="form-control panel-body" name="data[Person][hnextra]" value="<?php echo $person['hnextra']; ?>" <?php echo ((($user['role'] < $account['role']) OR $user['role']== 0)?'disabled':'')?> placeholder="Zusatz">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default birthdate">
                                <div class="panel-heading">Geburtsdatum</div>
                                <div class="input-group input-append date">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                    <input type="text" name="data[Person][birthdate]" class="form-control" value="<?php echo $person['birthdate'];?>" <?php echo ((($user['role'] < $account['role']) OR $user['role']== 0)?'disabled':'')?> placeholder="Geburtsdatum">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                <button type="submit" class="btn btn-primary" onclick="$('#userEditForm').submit();">Speichern</button>
            </div>
        </div>
    </div>

<?php echo $this->Html->scriptStart(array('inline' => true)); ?>
    $('#userEditForm > .Person > div > .birthdate > .date > .form-control').datepicker({
        format: 'dd.mm.yyyy',
        language: "de"
    });

    $('#userEditForm').submit(function(event) {
        $.post('<?php echo $this->webroot;?>users/edit/<?php echo $accId; ?>', $('#userEditForm').serialize(), function(json) {
            if(json.success == true)
            {
                notificateUser(json.message, 'success');

                $('.modal').modal('hide');
                $( "#userEntries" ).trigger({
                    type:"userChanged",
                    accountId:<?php echo $accId; ?>
                });
            } else {
                notificateUser(json.message);

                //delete old errors
                $('#userEditForm').children().each(function() {
                    $(this).children().each(function() {
                        $(this).children('div').each(function() {
                            $(this).addClass('panel-default').removeClass('panel-danger has-error');
                            $(this).children('.panel-footer').remove();
                        });
                    });
                });

                for(var controller in json.errors) {
                    for(var key in json.errors[controller]) {
                        if(json.errors[controller].hasOwnProperty(key)) {
                            notificateUser(json.errors[controller][key]);
                            var ele = $('#userEditForm > .'+controller+' > div > .'+key);
                            ele.addClass('panel-danger has-error');
                            ele.append('<div class="panel-footer">'+json.errors[controller][key]+'</div>');
                        }
                    }
                }

            }
        }, 'json');
        event.preventDefault();
    });
    $('.modal').on('hidden.bs.modal', function (e) {
        $('.modal').remove();
    });
<?php echo $this->Html->scriptEnd(); ?>
    <style>
        .datepicker{z-index:1151 !important;}
    </style>
</div>