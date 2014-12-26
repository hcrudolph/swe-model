<?php
echo $this->element('courseIndexElement', array('course' =>$course));
?>
<?php echo $this->Html->scriptStart(array('inline' => true));?>
collapseAddHandler();
<?php echo $this->Html->scriptEnd(); ?>