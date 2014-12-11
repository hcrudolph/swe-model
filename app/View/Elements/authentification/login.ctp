<paper-input label="Username" id="loginUsername"></paper-input>
<paper-input-decorator  label="Passwort" id="loginPassword" type="password">
    <input is="core-input" type="password" />
</paper-input-decorato>
<paper-icon-button icon="input" id="loginSubmit" onclick="loginSubmit()"></paper-icon-button>
<?php echo $this->Html->scriptStart(array('inline' => true)); ?>
    function loginSubmit()
    {
        $.post('<?php echo $this->webroot;?>accounts/login',
        {
            username:$('#loginUsername').val(),
            password:$('#loginPassword').val(),
        }, function(json) {
            if(json.login == true)
            {
                notificateUser(json.message, 'success');
                $('#sidebar').replaceWith(json.sidebar);
                $('#authentification').html(json.logout);
            } else
            {
                notificateUser(json.message);
            }
        }, 'json');
    }
<?php echo $this->Html->scriptEnd(); ?>