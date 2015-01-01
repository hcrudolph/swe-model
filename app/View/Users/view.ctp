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

    <table class="table">
        <tr>
            <td class="col-md-6"><b>Rolle: </b>
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
            </td>
            <td class="col-md-6"><b>Email: </b>
                <?php
                if ($email == Null) {
                    echo "--";
                } else {
                    echo $email;
                }
                ?>
            </td>
        </tr>
        <tr>
            <td class="col-md-6"><b>Geburtsdatum: </b>
                <?php
                if ($birthdate == Null) {
                    echo "--";
                } else {
                    echo $birthdate;
                }
                ?>
            </td>
            <td class="col-md-6"><b>Telefon: </b>
                <?php
                if ($phone == Null) {
                    echo "--";
                } else {
                    echo $phone;
                }
                ?>
            </td>
        </tr>
        <tr>
            <td class="col-md-6"><b>Strasse: </b>
                <?php
                if ($street == Null) {
                    echo "--";
                } else {
                    echo $street;
                }
                ?>
            </td>
            <td class="col-md-6"><b>Hausnummer: </b>
                <?php
                if ($housenumber == Null) {
                    echo "--";
                } else {
                    echo $housenumber;
                }
                ?>
            </td>
        </tr>
        <tr>
            <td class="col-md-6"><b>Zusatz: </b>
                <?php
                if ($hnextra == Null) {
                    echo "--";
                } else {
                    echo $hnextra;
                }
                ?>
            </td>
            <td class="col-md-6"><b>PLZ: </b>
                <?php
                if ($plz == Null) {
                    echo "--";
                } else {
                    echo $plz;
                }
                ?>
            </td>
        </tr>
        <tr>
            <td  class="col-md-6">
                <b>Stadt: </b>
                <?php
                if ($city == Null) {
                    echo "--";
                } else {
                    echo $city;
                }
                ?>
            </td>
            <td class="col-md-6"></td>
        </tr>
    </table>
</div>