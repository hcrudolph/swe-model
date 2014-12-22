<?php
    $addId = ((isset($addId))?$addId:'');
?>
<form id="postAddForm<?php echo $addId;?>">
    <div class="control-group Post">
        <div class="heading">
            <input type="input" class="form-control" name="data[Post][heading]" placeholder="Betreff">
        </div>
        <div class="body">
            <textarea name="data[Post][body]" class="body form-control" rows="3" placeholder="Body"></textarea>
        </div>
        <div class="visiblebegin">
            <div class="input-group input-append date">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-calendar"></i>
                </span>
                <input type="text" name="data[Post][visiblebegin]" class="form-control ">
                <span class="input-group-addon" onclick="alert('clear');">
                    <i class="glyphicon glyphicon-remove-circle"></i>
                </span>
            </div>
        </div>
        <div class="visibleend">
            <div class="input-group input-append date">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-calendar"></i>
                </span>
                <input type="text" name="data[Post][visibleend]" class="form-control ">
                <span class="input-group-addon" onclick="alert('clear');">
                    <i class="glyphicon glyphicon-remove-circle"></i>
                </span>
            </div>
        </div>
    </div>


    <button type="submit" id="postAddSaveButton" class="btn btn-default"><i class="glyphicon glyphicon-floppy-disk"></i>Speichern</button>
    <button type="button" id="postAddCloseButton" class="btn btn-default" onclick="postAddFormClose(<?php echo $addId;?>)"><i class="glyphicon glyphicon-minus"></i>Schließen</button>
</form>


<?php echo $this->Html->scriptStart(array('inline' => true)); ?>
    postAddFormAddSubmitEvent(<?php echo $addId;?>);

    $("#postAddForm<?php echo $addId;?> > .Post > .visiblebegin > .date > .form-control").datepicker({
        format: 'dd.mm.yyyy',
        language: 'de'
    });
    $("#postAddForm<?php echo $addId;?> > .Post > .visibleend > .date > .form-control").datepicker({
        format: 'dd.mm.yyyy',
        language: 'de'
    });


<?php echo $this->Html->scriptEnd();?>