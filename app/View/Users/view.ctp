<?php
$account = $userResult['Account'];
$person = $userResult['Person'];
?>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Account</h2>
            </div>
            <div class="panel-body">
                <div class="col-xs-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Username</h2>
                        </div>
                        <div class="panel-body">
                            <?php echo h($userResult['Account']['username']); ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Rolle</h2>
                        </div>
                        <div class="panel-body">
                            <?php
                            // Nicht Zahl für Rolle sondern String soll ausgegeben werden, extra function oder gibt es schon
                            echo h($userResult['Account']['role']);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Created</h2>
                        </div>
                        <div class="panel-body">
                            <?php
                            echo h($userResult['Account']['created']);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Person</h3>
            </div>
            <div class="panel-body">
                <div class="col-xs-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Nachname</h2>
                        </div>
                        <div class="panel-body">
                            <?php echo h($userResult['Person']['name']); ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Vorname</h2>
                        </div>
                        <div class="panel-body">
                            <?php
                            echo h($userResult['Person']['surname']);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Email</h2>
                        </div>
                        <div class="panel-body">
                            <?php
                            echo h($userResult['Person']['email']);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Geburtsjahr</h2>
                        </div>
                        <div class="panel-body">
                            <?php
                            echo h($userResult['Person']['birthdate']);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Strasse</h2>
                        </div>
                        <div class="panel-body">
                            <?php
                            echo h($userResult['Person']['street']);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Hausnummer</h2>
                        </div>
                        <div class="panel-body">
                            <?php
                            // Nicht Zahl für Rolle sondern String soll ausgegeben werden
                            echo h($userResult['Person']['housenumber']);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Zusatz</h2>
                        </div>
                        <div class="panel-body">
                            <?php
                            // Nicht Zahl für Rolle sondern String soll ausgegeben werden
                            echo h($userResult['Person']['hnextra']);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">PLZ</h2>
                        </div>
                        <div class="panel-body">
                            <?php
                            echo h($userResult['Person']['plz']);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Stadt</h2>
                        </div>
                        <div class="panel-body">
                            <?php
                            echo h($userResult['Person']['city']);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Telefon</h2>
                        </div>
                        <div class="panel-body">
                            <?php
                            echo h($userResult['Person']['phone']);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>