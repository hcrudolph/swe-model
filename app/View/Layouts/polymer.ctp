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
		            echo $this->element('sidebar/submenuNews');
		            echo $this->element('sidebar/submenuKalender');
		            echo $this->element('sidebar/submenuListen');
		            echo $this->element('sidebar/submenuStudio');
		            echo $this->element('sidebar/submenuUser');
		            echo $this->element('sidebar/submenuKurs');
			?>
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
