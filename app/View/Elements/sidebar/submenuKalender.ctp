<core-submenu id="sidebarSubmenuKalender" icon="today" label="Kalender"></core-submenu>
<?php
echo $this->Html->scriptStart(array('inline' => true));
?>
document.querySelector('#sidebarSubmenuKalender').addEventListener('tap', function(e) {
    $('#content').html('');
    $('#content').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
        firstDay: 1,
        axisFormat: 'H:mm - {H:mm}',
        lang:'de',
        allDaySlot: true,
        weekNumbers: true,
        defaultView: 'basicWeek',
        editable: true,
        events: '<?php echo $this->webroot?>/' 
    });
});
<?php
echo $this->Html->scriptEnd();
?>