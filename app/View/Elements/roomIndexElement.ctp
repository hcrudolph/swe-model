<?php
$roomId = $room['Room']['id'];
?>

<tr id="roomIndexEntry<?php echo $roomId; ?>">
    <td><?php echo h($room['Room']['name']); ?></td>
    <td>
        <?php if(isset($user) AND $user['role'] > 1) {?>
        <div class="btn-group">
            <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="roomEdit(<?php echo $roomId; ?>);">Bearbeiten</a>
            <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="roomDelete(<?php echo $roomId; ?>);">Löschen</a>
        </div>
        <?php } ?>
    </td>
</tr>