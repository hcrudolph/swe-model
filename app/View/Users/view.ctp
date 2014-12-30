<?php
$username = $userResult['Account']['username'];
$role = $userResult['Account']['role'];
$name = $userResult['Person']['name'];
$surname = $userResult['Person']['surname'];
$email = $userResult['Person']['email'];
$birthdate = $userResult['Person']['birthdate'];
$street = $userResult['Person']['street'];
$housenumber = $userResult['Person']['housenumber'];
$hnextra = $userResult['Person']['hnextra'];
$plz = $userResult['Person']['plz'];
$city = $userResult['Person']['city'];
$phone = $userResult['Person']['phone'];
?>

<div class="row">
<div class="col-xs-7">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Username</h2>
        </div>
        <div class="panel-body">
            <?php
            if ($username == Null) {
                echo "--";
            } else {
                echo $username;
            }
            ?>
        </div>
    </div>
</div>
<div class="col-xs-5">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Rolle</h2>
        </div>
        <div class="panel-body">
            <?php
            switch ($userResult['Account']['role']) {
                case 0:
                    echo "Mitglied";
                    break;
                case 1:
                    echo "Mitarbeiter";
                    break;
                case 2:
                    echo "Administrator";
                    break;
            }
            ?>
        </div>
    </div>
</div>
    </div>
<div class="row">
<div class="col-xs-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Nachname</h2>
        </div>
        <div class="panel-body">
            <?php
            if ($name == Null) {
                echo "--";
            } else {
                echo $name;
            }
            ?>
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
            if ($surname == Null) {
                echo "--";
            } else {
                echo $surname;
            }
            ?>
        </div>
    </div>
</div>
    </div>
<div class="row">
<div class="col-xs-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Email</h2>
        </div>
        <div class="panel-body">
            <?php
            if ($email == Null) {
                echo "--";
            } else {
                echo $email;
            }
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
            if ($birthdate == Null) {
                echo "--";
            } else {
                echo $birthdate;
            }
            ?>
        </div>
    </div>
</div>
    </div>
<div class="row">
<div class="col-xs-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Strasse</h2>
        </div>
        <div class="panel-body">
            <?php
            if ($street == Null) {
                echo "--";
            } else {
                echo $street;
            }
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
            if ($housenumber == Null) {
                echo "--";
            } else {
                echo $housenumber;
            }
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
            if ($hnextra == Null) {
                echo "--";
            } else {
                echo $hnextra;
            }
            ?>
        </div>
    </div>
</div>
    </div>
<div class="row">
<div class="col-xs-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">PLZ</h2>
        </div>
        <div class="panel-body">
            <?php
            if ($plz == Null) {
                echo "--";
            } else {
                echo $plz;
            }
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
            if ($city == Null) {
                echo "--";
            } else {
                echo $city;
            }
            ?>
        </div>
    </div>
</div>
    </div>
<div class="row">
<div class="col-xs-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Telefon</h2>
        </div>
        <div class="panel-body">
            <?php
            if ($phone == Null) {
                echo "--";
            } else {
                echo $phone;
            }
            ?>
        </div>
    </div>
</div>
    </div>