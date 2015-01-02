<p>Sie sind als <?php echo $user['Person']['surname']; ?> <?php echo $user['Person']['name']; ?> (<?php echo $user['username']; ?>) eingeloggt.</p>

<button type="button" class="btn btn-default pull-right" id="logoutButton" onclick="logoutSubmit()">Logout</button>

<?php echo $this->Html->scriptStart(array('inline' => true)); ?>
    function logoutSubmit()
    {
        $.post('<?php echo $this->webroot;?>accounts/logout', function(json) {
            if(json.logout == true)
            {
                notificateUser(json.message, 'success');
                $('#sidebar').replaceWith(json.sidebar);
                $('#authentification').html(json.login);
                //startpage always posts
                $('#content').load('<?php echo $this->webroot;?>posts/index')
            } else
            {
                notificateUser(json.message);
            }
        }, 'json');
    }
<?php echo $this->Html->scriptEnd(); ?>