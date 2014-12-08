<core-submenu id="sidebarSubmenuStudio" icon="settings" label="Studiomanagement"></core-submenu>
<?php
echo $this->Html->scriptStart(array('inline' => true));
?>
document.querySelector('#sidebarSubmenuStudio').addEventListener('tap', function(e) {
    $( "#content" ).load( "<?php echo $this->webroot;?>studio");
});


<?php
echo $this->Html->scriptEnd();
?>