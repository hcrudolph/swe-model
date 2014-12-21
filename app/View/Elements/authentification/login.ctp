<form id="loginForm">
    <input type="input" class="form-control" name="data[Account][username]" placeholder="Username">
    <input type="password" class="form-control" name="data[Account][password]" placeholder="Passwort">
    <button type="submit" class="btn btn-default" id="loginSubmit">Login</button>
</form>
<?php echo $this->Html->scriptStart(array('inline' => true)); ?>
    $(document).ready(function() {
        $('#loginForm').submit(function(event) {
            $.post('<?php echo $this->webroot;?>accounts/login', $('#loginForm').serialize(), function(json) {
                if(json.login == true)
                {
                    notificateUser(json.message, 'success');
                    $('#sidebar').replaceWith(json.sidebar);
                    $('#authentification').html(json.logout);
                    //startpage always posts
                    $('#content').load('<?php echo $this->webroot;?>posts');
                } else
                {
                    notificateUser(json.message);
                }
            }, 'json');
        event.preventDefault();
        });
    });
<?php echo $this->Html->scriptEnd(); ?>