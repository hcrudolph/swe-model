<core-submenu id="sidebarSubmenuListen" icon="account-circle" label="Listen"></core-submenu>
<?php
echo $this->Html->scriptStart(array('inline' => true));
?>
    document.querySelector('#sidebarSubmenuListen').addEventListener('tap', function(e) {
        $("#content").load( "<?php echo $this->webroot;?>listen");
    });
<?php
echo $this->Html->scriptEnd();
?>