<?php
$certificateId = $certificate['Certificate']['id'];
?>

<tr id="certificateIndexEntry<?php echo $certificateId; ?>">
    <td><?php echo h($certificate['Certificate']['name']); ?></td>
    <td>
        <?php if(isset($user) AND $user['role'] > 1) {?>
            <div class="btn-group">
                <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="certificateEdit(<?php echo $certificateId; ?>);">Bearbeiten</a>
                <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="certificateDelete(<?php echo $certificateId; ?>);">Löschen</a>
            </div>
        <?php } ?>
    </td>
</tr>
