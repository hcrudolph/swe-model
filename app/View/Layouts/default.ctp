<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		//test
		$this->Html->script('webcomponenets', array('inline' => false));
		echo $this->Html->meta(array(
    			'rel' => 'import',
    			'href' => './polymer/login.html',
		));
		echo $this->Html->meta(array(
    			'rel' => 'import',
    			'href' => './polymer/sidebar.html',
		));
	?>
</head>
<body>
	<div id="container">
		<div id="header">
           <a href="/swe-project/">header</a>
		</div>

        <div id="sidebar">
        <ul>
        <?php
            $this->start('sidebar');
            echo $this->element('sidebar/calendar');
            echo $this->element('sidebar/news');
            echo $this->element('sidebar/courses');
            echo $this->element('sidebar/courseroomtimes');
            echo $this->element('sidebar/accounts');
            $this->end();

            echo $this->fetch('sidebar');
        ?>
        </ul>
        </div>

		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>

		<div id="footer">
            footer
		</div>
	</div>
</body>
</html>
