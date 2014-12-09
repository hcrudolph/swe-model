<core-submenu id="sidebarSubmenuUser" icon="settings" label="Usermanagement"></core-submenu>
<?php
echo $this->Html->scriptStart(array('inline' => true));
?>
document.addEventListener('polymer-ready', function(){
document.querySelector('#sidebarSubmenuUser').addEventListener('tap', function(e) {
    $( "#content" ).load( "<?php echo $this->webroot;?>user");
});
});
<?php
echo $this->Html->scriptEnd();
?>