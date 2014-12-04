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
		echo $this->Html->script('/polymer/components/webcomponentsjs/webcomponents');
  		echo $this->Polymer->template('components/polymer/polymer.html');
  		echo $this->Polymer->template('elements/application-login.html');
  		
  		
		echo $this->Polymer->template('components/core-menu/core-submenu.html');
		echo $this->Polymer->template('components/core-icons/core-icons.html');
		echo $this->Polymer->template('components/core-icon/core-icon.html');
		echo $this->Polymer->template('components/core-item/core-item.html');
  		
  	?>
  <!-- polymer-data end-->
    <?php
        echo $this->Html->css('application');
        echo $this->Html->script('application');
    ?>
    <!--Application-data start -->
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('cake.generic');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<a href="/swe-project/">header</a>
			<application-login id="login"></application-login>
		</div>
		<core-menu selected="0" selectedindex="0" id="sidebar">
			<?php
			/*$this->start('sidebar');
		            echo $this->element('sidebar/calendar');
		            echo $this->element('sidebar/news');
		            echo $this->element('sidebar/courses');
		            echo $this->element('sidebar/courseroomtimes');
		            echo $this->element('sidebar/accounts');
		            $this->end();*/
		            echo $this->element('sidebar/submenuNews');
			?>
			<!--<core-submenu id="sidebarSubmenuNews" icon="speaker-notes" label="Neuigkeiten"></core-submenu>-->
			<core-submenu id="sidebarSubmenuKalender" icon="today" label="Kalender"></core-submenu>
			<core-submenu id="sidebarSubmenuListen" icon="account-circle" label="Listen"></core-submenu>
			<core-submenu id="sidebarSubmenuStudio" icon="settings" label="Studiomanagement"></core-submenu>
			<core-submenu id="sidebarSubmenuUser" icon="settings" label="Usermanagement"></core-submenu>
			<core-submenu id="sidebarSubmenuKurs" icon="settings" label="Kursmanagement"></core-submenu>
		</core-menu>
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
