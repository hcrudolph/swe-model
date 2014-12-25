<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $this->fetch('title'); ?>
        </title>
        <meta name="viewport" content="width=device-width, ,height=device-height, initial-scale=1.0, maximum-scale=1.0">
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
        echo $this->Html->script('datepicker/locales/bootstrap-datepicker.de');
        echo $this->Html->css('datepicker3');
        ?>
        <!--Datepicker-data end -->
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
                            notificateUser('Sie dürfen diese Aktion nicht ausführen.');
                        } else if(x.status === 404) {
                            notificateUser('Die Ressource wurde nicht gefunden.');
                        }
                        } else if(x.status === 405) {
                            notificateUser('Die Anfrage-Methode ist nicht erlaubt..');
                        } else if(x.status === 501) {
                            notificateUser('Für diese Aktion existiert keine Implementierung.');
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
                <div id="postsBar">
                </div>
                <?php echo $this->Html->scriptStart(array('inline' => true)); ?>
                    $(function () {
                        $('#postsBar').load('<?php echo $this->webroot; ?>posts/slider');
                    });
                <?php echo $this->Html->scriptEnd(); ?>
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
            <?php echo $this->element('sidebar'); ?>
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
