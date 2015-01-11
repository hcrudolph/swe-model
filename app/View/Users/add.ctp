<div class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nutzer anmelden</h4>
            </div>
            <div class="modal-body">
                <form id="userAddForm">
                    <div class="control-group Account row">
                        <div class="col-xs-6">
                            <div class="panel panel-default username">
                                <div class="panel-heading">Username</div>
                                <input type="input" class="form-control panel-body" name="data[Account][username]" placeholder="Username">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default role">
                                <div class="panel-heading">Rolle des Nutzers</div>
                                <select name="data[Account][role]" class="form-control panel-body" style="padding:0px;">
                                    <option value="0" selected="selected">Mitglied</option>
                                    <?php echo (($user['role']==2)?'<option value="1">Mitarbeiter</option>':'')?>
                                    <?php echo (($user['role']==2)?'<option value="2">Administrator</option>':'')?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default password">
                                <div class="panel-heading">Passwort</div>
                                <input type="password" class="form-control panel-body" name="data[Account][password]" placeholder="Passwort">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default passwordRepeat">
                                <div class="panel-heading">Passwort wiederholen</div>
                                <input type="password" class="form-control panel-body" name="data[Account][passwordRepeat]" placeholder="Passwort wiederholen">
                            </div>
                        </div>
                    </div>
                    <div class="control-group Person row">
                        <div class="col-xs-6">
                            <div class="panel panel-default email">
                                <div class="panel-heading">Email</div>
                                <input type="input" class="form-control panel-body" name="data[Person][email]" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default name">
                                <div class="panel-heading">Nachname</div>
                                <input type="input" class="form-control panel-body" name="data[Person][name]" placeholder="Nachname">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default surname">
                                <div class="panel-heading">Vorname</div>
                                <input type="input" class="form-control panel-body" name="data[Person][surname]" placeholder="Vorname">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default phone">
                                <div class="panel-heading">Telefon/Handy</div>
                                <input type="input" class="form-control panel-body" name="data[Person][phone]" placeholder="Telefon/Handy">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default plz">
                                <div class="panel-heading">Postleitzahl</div>
                                <input type="input" class="form-control panel-body" name="data[Person][plz]" placeholder="PLZ">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default city">
                                <div class="panel-heading">Stadt</div>
                                <input type="input" class="form-control panel-body" name="data[Person][city]" placeholder="Stadt">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default street">
                                <div class="panel-heading">Straße</div>
                                <input type="input" class="form-control panel-body" name="data[Person][street]" placeholder="Straße">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default housenumber">
                                <div class="panel-heading">Hausnummer</div>
                                <input type="input" class="form-control panel-body" name="data[Person][housenumber]" placeholder="Hausnummer">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default hnextra">
                                <div class="panel-heading">Hausnummerzusatz</div>
                                <input type="input" class="form-control panel-body" name="data[Person][hnextra]" placeholder="Zusatz">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default birthdate">
                                <div class="panel-heading">Geburtsdatum</div>
                                <div class="input-group input-append date">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                    <input type="text" name="data[Person][birthdate]" class="form-control " placeholder="Geburtsdatum">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                <button type="submit" class="btn btn-primary" onclick="$('#userAddForm').submit();">Speichern</button>
            </div>
        </div>
    </div>
    <?php echo $this->Html->scriptStart(array('inline' => true)); ?>

        $(function(){
            $('#userAddForm > .Person > div > .birthdate > .date > .form-control').datepicker({
                format: 'dd.mm.yyyy',
                language: "de"
            });
        });

        $(document).ready(function() {
            $('#userAddForm').submit(function(event) {
                $.post('<?php echo $this->webroot;?>users/add/', $('#userAddForm').serialize(), function(json) {
                    if(json.success == true) {
                        notificateUser(json.message, 'success');

                        $.get('<?php echo $this->webroot?>users/listing/', function( view ) {
                            $('#userListing').replaceWith(view);
                            $('.modal').modal('hide');
                        });
                    } else {
                        notificateUser(json.message);

                        //delete old errors
                        $('#userAddForm').children().each(function() {
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
                                    var ele = $('#userAddForm > .'+controller+' > div > .'+key);
                                    ele.addClass('panel-danger has-error');
                                    ele.append('<div class="panel-footer">'+json.errors[controller][key]+'</div>');
                                }
                            }
                        }
                    }
                }, 'json');
                event.preventDefault();
            });
        });
        $('.modal').on('hidden.bs.modal', function (e) {
            $('.modal').remove();
        });
    <?php echo $this->Html->scriptEnd(); ?>
    <style>
        .datepicker{z-index:1151 !important;}
    </style>
</div>