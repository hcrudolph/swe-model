<?php
//global vars
$user = $this->Session->read('Auth.User');

$controllerIndex = array(
    '' => 0,
    '' => 1,
    '' => 2,
    'studio' => 3,
    '' => 4,
    '' => 5
);
$sidebarIndex = ((array_key_exists($this->params['controller'], $controllerIndex))?$controllerIndex[$this->params['controller']]:0);

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	<meta name="viewport" content="width=device-width, ,height=device-height, initial-scale=1.0, maximum-scale=1.0">
	<!-- polymer-data start-->
	<?php
		echo $this->Html->script('/polymer/components/webcomponentsjs/webcomponents');
  		echo $this->Polymer->template('components/polymer/polymer.html');
  		echo $this->Polymer->template('elements/application-login.html');
  		
  		//Include Sidebar
		echo $this->Polymer->template('components/core-menu/core-submenu.html');
		echo $this->Polymer->template('components/core-icons/core-icons.html');
		echo $this->Polymer->template('components/core-icon/core-icon.html');
		echo $this->Polymer->template('components/core-item/core-item.html');
        
        //Include Tabs
        echo $this->Polymer->template('components/paper-tabs/paper-tabs.html');
        echo $this->Polymer->template('components/paper-tabs/paper-tab.html');
        //Include Pages
        echo $this->Polymer->template('components/core-pages/core-pages.html');
  		
  	?>
    <!-- polymer-data end-->
    <?php
        echo $this->Html->script('jquery-2.1.1.min');
        echo $this->Html->css('application');
        echo $this->Html->script('application');
    ?>
    <!--Application-data start -->
    <!--Fullcalendar-data start-->
    <?php
        echo $this->Html->script('moment');
        echo $this->Html->script('fullcalendar.min');
        echo $this->Html->css('fullcalendar.min');
    ?>
    <!--Fullcalendar-data start-->
</head>
<body>
	<div id="container">
		<div id="header">
            <?php
                //if (empty($user))
                    echo '<application-login id="login"></application-login>';
                //else
                    //echo '<div id=login></div>';
            ?>
		</div>
		<core-menu selected="<?php echo $sidebarIndex*2 ?>" selectedindex="<?php echo $sidebarIndex*2 ?>" id="sidebar">
			<?php
		            echo $this->element('sidebar/submenuNews');
		            echo $this->element('sidebar/submenuKalender');
		            //if (!empty($user))
                    {
                        echo $this->element('sidebar/submenuListen');
                        echo $this->element('sidebar/submenuStudio');
                        echo $this->element('sidebar/submenuUser');
                        echo $this->element('sidebar/submenuKurs');
                    }
            
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
