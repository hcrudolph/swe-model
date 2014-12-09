<core-submenu id="sidebarSubmenuKurs" icon="settings" label="Kursmanagement"></core-submenu>
<?php
echo $this->Html->scriptStart(array('inline' => true));
?>
document.addEventListener('polymer-ready', function(){
    document.querySelector('#sidebarSubmenuKurs').addEventListener('tap', function(e) {
        $( "#content" ).load( "<?php echo $this->webroot;?>Kurs");
    });
});
<?php
echo $this->Html->scriptEnd();
?>