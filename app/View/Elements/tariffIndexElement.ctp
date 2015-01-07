<?php
$tariffId = $tariff['Tariff']['id'];
?>


<tr id="tariffIndexEntry<?php echo $tariffId; ?>">
    <td><?php echo h($tariff['Tariff']['description']); ?></td>
    <td>
        <div class="btn-group">
            <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="tariffEdit(<?php echo $tariffId; ?>);">Bearbeiten</a>
            <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="tariffDelete(<?php echo $tariffId; ?>);">Löschen</a>
        </div>
    </td>
</tr>