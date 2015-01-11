<?php
$postId = $post['Post']['id'];
$visibleBegin = $post['Post']['visiblebegin'];
$visibleEnd = $post['Post']['visibleend'];
?>
<div class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Post hinzufügen</h4>
            </div>
            <div class="modal-body">
                <form id="postEditForm">
                    <div class="control-group Post row">
                        <div class="col-xs-12">
                            <div class="panel panel-default heading">
                                <div class="panel-heading">Betreff</div>
                                <input type="input" class="form-control panel-body" name="data[Post][heading]" value="<?php echo $post['Post']['heading'];?>" placeholder="Betreff">
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="panel panel-default body">
                                <div class="panel-heading">Freitext</div>
                                <textarea name="data[Post][body]" class="panel-body form-control" rows="3" placeholder="Freitext"><?php echo $post['Post']['body'];?></textarea>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default visiblebegin">
                                <div class="panel-heading">Anzeigen von</div>
                                <div class="input-group input-append date">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                    <input type="text" name="data[Post][visiblebegin]" value="<?php echo $visibleBegin; ?>"class="form-control">
                                    <span class="input-group-addon" onclick="$(this).parent().children('.form-control').val('');">
                                        <i class="glyphicon glyphicon-remove-circle"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default visibleend">
                                <div class="panel-heading">Anzeigen bis</div>
                                <div class="input-group input-append date">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                    <input type="text" name="data[Post][visibleend]" value="<?php echo $visibleEnd; ?>" class="form-control ">
                                    <span class="input-group-addon" onclick="$(this).parent().children('.form-control').val('');">
                                        <i class="glyphicon glyphicon-remove-circle"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                <button type="submit" class="btn btn-primary" onclick="$('#postEditForm').submit();">Speichern</button>
            </div>
        </div>
    </div>
    <?php echo $this->Html->scriptStart(array('inline' => true)); ?>
        postEditFormAddDatepicker();
        postEditFormAddSubmitEvent(<?php echo $postId; ?>);
        $('.modal').on('hidden.bs.modal', function (e) {
            $('.modal').remove();
            $.get('<?php echo $this->webroot."posts/view/"?><?php echo $postId; ?>', function( view ) {
                $('#postEntry<?php echo $postId; ?>').replaceWith(view);
            });
        });
    <?php echo $this->Html->scriptEnd();?>
    <style>
        .datepicker{z-index:1151 !important;}
    </style>
</div>