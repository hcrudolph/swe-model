<form id="loginForm">
    <div class="input-group">
        <span class="input-group-addon">
            <i class="glyphicon glyphicon-user"></i>
        </span>
        <input type="input" class="form-control" name="data[Account][username]" placeholder="Username">
    </div>
    <div class="input-group">
        <span class="input-group-addon">
            <i class="glyphicon glyphicon-globe"></i>
        </span>
        <input type="password" class="form-control" name="data[Account][password]" placeholder="Passwort">
    </div>
    <button type="submit" class="btn btn-default pull-right" id="loginSubmit">Login</button>
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