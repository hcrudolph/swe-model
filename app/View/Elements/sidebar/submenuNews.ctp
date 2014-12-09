<core-submenu id="sidebarSubmenuNews" icon="speaker-notes" label="Neuigkeiten"></core-submenu>
<?php
echo $this->Html->scriptStart(array('inline' => true));
?>
document.addEventListener('polymer-ready', function(){
document.querySelector('#sidebarSubmenuNews').addEventListener('tap', function(e) {
    $( "#content" ).load( "<?php echo $this->webroot;?>posts");
});
});
<?php
echo $this->Html->scriptEnd();
?>