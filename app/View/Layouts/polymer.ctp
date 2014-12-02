<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<!-- polymer-data start-->
	<script type="text/javascript" src="polymer/components/webcomponentsjs/webcomponents.js"></script>
	<link rel="import" href="polymer/components/polymer/polymer.html">
  <link rel="import" href="polymer/elements/application-sidebar.html">
  <!-- polymer-data end-->
  
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('cake.generic');
		echo $this->Html->css('application.css');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
           <a href="/swe-project/">header</a>
		</div>
	<application-sidebar id="appsidebar" style="right:5px;"></application-sidebar>

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
