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
        <!--Datetimepicker-data start -->
        <?php
        echo $this->Html->script('datetimepicker/bootstrap-datetimepicker.min');
        echo $this->Html->css('bootstrap-datetimepicker.min');
        ?>
        <!--Datetimepicker-data end -->
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
                        } else if(x.status === 405) {
                            notificateUser('Die Anfrage-Methode ist nicht erlaubt..');
                        } else if(x.status === 501) {
                            notificateUser('Für diese Aktion existiert keine Implementierung.');
                        } else {
                            notificateUser("Fehler: " + status + "nError: " + error);
                        }
                    }
                });
            });
        <?php echo $this->Html->scriptEnd(); ?>
        <!--Jquery-Setup-end-->
        <!--Setup for non-mobile-devices-->
        <?php echo $this->Html->scriptStart(array('inline' => true)); ?>
            $(document).ready(function() {
                if (!navigator.userAgent.match(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Windows Phone|Opera Mini/i)) {
                    $('#container').css('width', '1000px');
                    $('#container').css('position','absolute');
                    $('#container').css('margin','0 auto');
                    $('#container').css('left', '50%');
                    $('#container').css('margin-left','-500px');
                }
            });
        <?php echo $this->Html->scriptEnd(); ?>
        <!--Setup end-->
    </head>
    <body>
        <div id="container">
            <div id="header">
                <div id="postsBar">
                </div>
                <?php echo $this->Html->scriptStart(array('inline' => true)); ?>
                loadPostsBar('<?php echo $this->webroot; ?>');
                setInterval(function(){
                    loadPostsBar('<?php echo $this->webroot; ?>');
                }, 10000*60); //reload every 10 Minutes
                <?php echo $this->Html->scriptEnd(); ?>
                <table id="openingTimes" class="table table-striped">
                    <tbody>
                        <tr>
                            <td colspan="3" class="openheader" height=44px >Öffnungszeiten</td>
                        </tr>
                        <tr>
                            <td height=30px ></td>
                            <td class="openvon" height=30px style="padding:8px;">von</td>
                            <td class="openbis" height=30px style="padding:8px;">bis</td>
                        <tr>
                            <td class="opentage" height=40px style="padding:5px 5px 5px 15px;">Montag bis <br>Donnerstag</td>
                            <td class="openvon" height=40px style="padding:13px 7px 13px 7px;">7:00 Uhr </td>
                            <td class="openbis" height=40px style="padding:13px 7px 13px 7px;">22:00 Uhr</td>
                        </tr>
                        <tr>
                            <td class="opentage" height=40px style="padding:5px 5px 5px 15px;">Freitag und <br>Samstag</td>
                            <td class="openvon" height=40px style="padding:13px 7px 13px 7px;">7:00 Uhr </td>
                            <td class="openbis" height=40px style="padding:13px 7px 13px 7px;">24:00 Uhr</td>
                        </tr>
                        <tr>
                            <td class="opentage" height=37px style="padding:12px 5px 11px 15px;">Sonntag</td>
                            <td class="openvon" height=37px style="padding:12px 7px 11px 7px;">8:00 Uhr </td>
                            <td class="openbis" height=37px style="padding:12px 7px 11px 7px;">20:00 Uhr</td>
                        </tr>
                    </tbody>
                </table>
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
                <b>SWE Fitness GmbH</b><br>
                Gustav-Freytag-Str. 42<br>
                04277 Leipzig<br>
<br>
                <b>Telefon:</b><br> +49 (0) 1806 - 6666-66<br>
                <b>Telefax:</b><br> +49 (0) 1806 - 6666-67<br>
<br>
                <b>E-Mail:</b> <br>info@swe-fitness.com<br>
                <b>Internet:</b> <br><a href="http://82.165.45.70/dev/swe-project/">www.swe-fitness.com</a><br>
            </div>
        </div>
    </body>
</html>
