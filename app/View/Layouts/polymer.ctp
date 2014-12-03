<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<!-- polymer-data start-->
	<?php
		//echo echo $this->Html->script('polymer/components/webcomponentsjs/webcomponents.js');
		//polymertag with right _tag-usage
	?>
	<!--<script type="text/javascript" src="polymer/components/webcomponentsjs/webcomponents.js"></script>-->
	<?php
		echo $this->Html->script('/polymer/components/webcomponentsjs/webcomponents');
  		echo $this->Polymer->template('components/polymer/polymer.html');
  		echo $this->Polymer->template('elements/application-sidebar.html');
  	?>
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
	<core-menu selected="2" selectedindex="2" id="sidebar">
		<core-submenu id="submenuNews" icon="speaker-notes" label="Neuigkeiten"></core-submenu>
		<core-submenu id="submenuKalender" icon="today" label="Kalender"></core-submenu>
		<core-submenu id="submenuListen" icon="account-circle" label="Listen"></core-submenu>
		<core-submenu id="submenuStudio" icon="settings" label="Studiomanagement"></core-submenu>
		<core-submenu id="submenuUser" icon="settings" label="Usermanagement"></core-submenu>
		<core-submenu id="submenuKurs" icon="settings" label="Kursmanagement"></core-submenu>
	</core-menu>
	
	<!--<application-sidebar id="appsidebar" style="right:5px;"></application-sidebar>-->

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
