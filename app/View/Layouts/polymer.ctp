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
        
        //login
        echo $this->Polymer->template('components/paper-input/paper-input.html');

        //logout
  		echo $this->Polymer->template('components/paper-button/paper-button.html');

  		//Include Sidebar
		echo $this->Polymer->template('components/core-menu/core-submenu.html');
		echo $this->Polymer->template('components/core-icons/core-icons.html');
		echo $this->Polymer->template('components/core-icon/core-icon.html');
		echo $this->Polymer->template('components/core-item/core-item.html');
        //Include Posts
        echo $this->Polymer->template('components/core-icon-button/core-icon-button.html');
        echo $this->Polymer->template('components/core-tooltip/core-tooltip.html');
        echo $this->Polymer->template('components/core-input/core-input.html');
        
        //Include Tabs
        echo $this->Polymer->template('components/paper-tabs/paper-tabs.html');
        echo $this->Polymer->template('components/paper-tabs/paper-tab.html');
        //Include Pages
        echo $this->Polymer->template('components/core-pages/core-pages.html');
  		
  	?>
    <!-- polymer-data end-->
    <!--Application-data start -->
    <?php
        echo $this->Html->script('jquery-2.1.1.min');
        echo $this->Html->css('application');
        echo $this->Html->script('application');
    ?>
    <!--Application-data end -->
    <!--Bootstrap-data start -->
    <?php
    echo $this->Html->script('bootstrap.min');
    echo $this->Html->css('bootstrap-theme.min');
    echo $this->Html->css('bootstrap.min');
    ?>
    <!--Bootstrap-data end -->
    
    <!--Datepicker-data start -->
    <?php
    echo $this->Html->script('datepicker/bootstrap-datepicker');
    echo $this->Html->css('datepicker3');
    ?>
    <!--Datepicker-data end -->
    <!--Bootstrap-selector-data start-->
    <?php
    echo $this->Html->script('bootstrap-select/bootstrap-select.min');
    echo $this->Html->css("bootstrap-select.min");
    ?>
    <!--Bootstrap-selector-data end-->
    <!--Noty-data start-->
    <?php
        echo $this->Html->script('noty/jquery.noty.packaged.min');
        echo $this->Html->script('noty/topRight');
        echo $this->Html->script('noty/default');
    ?>
    <!--Noty-data end-->
    
    
    <!--Fullcalendar-data start-->
    <?php
        echo $this->Html->script('moment');
        echo $this->Html->script('fullcalendar.min');
        echo $this->Html->script('fullcalendar.lang');
        echo $this->Html->css('fullcalendar');
        echo $this->Html->css('fullcalendar.print', array('media' => 'print'));
    ?>
    <!--Fullcalendar-data start-->

    <!--JQuery-Setup: grundlegende Einstellungen-->
    <?php echo $this->Html->scriptStart(array('inline' => true)); ?>
        $(function () {
            //setup ajax error handling
            $.ajaxSetup({
                error: function (x, status, error) {
                    if (x.status === 403) {
                        notificateUser('Sie dürfen diese Aktion nicht ausführen');
                    } else if(x.status === 501) {
                        notificateUser('Für diese Aktion existiert keine Implementierung');
                    }
                    else {
                        notificateUser("Fehler: " + status + "nError: " + error);
                    }
                }
            });
        });
    <?php echo $this->Html->scriptEnd(); ?>
    <!--Jquery-Setup-end-->
</head>
<body>
	<div id="container">
		<div id="header">
            <div id="authentification">
                <?php if(empty($user))
                {
                    echo $this->element('authentification/login');
                } else
                {
                    echo $this->element('authentification/logout');
                }
                ?>
            </div>
		</div>
        <?php echo $this->element('sidebar/sidebar'); ?>
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
