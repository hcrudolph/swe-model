<?php
$account = $userResult['Account'];
$person = $userResult['Person'];
?>

<button type="button" class="btn btn-default" onclick="userEdit(<?php echo $account['id']; ?>)"><i class="glyphicon glyphicon-pencil"></i> Bearbeiten</button>
============================<br>
<?php
echo var_dump($account).'<br>';
echo var_dump($person).'<br>';

echo "============================<br>";
?>