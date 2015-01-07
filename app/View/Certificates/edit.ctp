<div class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Zertifikat bearbeiten</h4>
            </div>
            <div class="modal-body">
                <form id="certificateEditForm">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="row Certificate">
                                <div class="col-md-12">
                                    <div class="panel panel-default name">
                                        <div class="panel-heading">Name</div>
                                        <input type="input" class="form-control panel-body" name="data[Certificate][name]" value="<?php echo $certificate['Certificate']['name'];?>" placeholder="Name">
                                    </div>
                                </div>
                            </div>
                            <div class="row Certificate">
                                <div class="col-md-12">
                                    <div class="panel panel-default description">
                                        <div class="panel-heading">Beschreibung</div>
                                        <textarea name="data[Certificate][description]" class="body form-control panel-body" rows="3" placeholder="Beschreibung des Zertifikat"><?php echo $certificate['Certificate']['description'];?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <select name="data[Account][Account][]" class="form-control" multiple size="10">
                            <?php foreach($users as $userInfo) {
                                $userId = $userInfo['Account']['id'];
                                $userHasCert = false;
                                foreach($certificate['Account'] as $account)
                                {
                                    if($account['id']==$userId) {$userHasCert = true; break;}
                                }
                                echo '<option value="'.$userId.'" '.(($userHasCert)?'selected':'').'>'.$userInfo['Person']['surname'].' '.$userInfo['Person']['name'].' ('.$userInfo['Account']['username'].')</option>';
                            }?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                <button type="button" class="btn btn-primary" onclick="$('#certificateEditForm').submit();">Speichern</button>
            </div>
        </div>
    </div>
    <?php echo $this->Html->scriptStart(array('inline' => true));?>
    $('#certificateEditTabbar > .nav-tabs a').click(function (e) {
        e.preventDefault();
            $(this).tab('show');
        });
        $('.modal').on('hidden.bs.modal', function (e) {
        $('.modal').remove();
    });
    certificateEditFormAddSubmitEvent(<?php echo $certificate['Certificate']['id'];?>);
    <?php echo $this->Html->scriptEnd();?>
</div>