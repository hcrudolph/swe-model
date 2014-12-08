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
			right: 'month,agendaWeek,agendaDay'
		},
        lang:'de',
        defaultView: 'agendaWeek',
		editable: false,
		eventLimit: true,
		events: '<?php echo $this->webroot?>dates/events'
    });
});
<?php
echo $this->Html->scriptEnd();
?>