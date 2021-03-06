<div class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Termin bearbeiten</h4>
			</div>
			<div class="modal-body">
				<div id="dateEditTabbar" role="tabpanel">
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#dateEditData">Termindaten</a></li>
						<li role="presentation"><a href="#dateEditTeilnehmer">Teilnehmer</a></li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="dateEditData">
							<form id="dateEditForm">
								<div class="control-group Date row">
									<div class="col-xs-12">
										<div class="panel panel-default course_id">
											<div class="panel-heading">Kurs</div>
											<select name="data[Date][course_id]" class="form-control panel-body" style="padding:0px;">
												<?php
												echo '<option value="'.$date['Course']['id'].'" selected="selected">'.$date['Course']['name'].' (Schwierigkeit: '.$date['Course']['level'].')</option>';
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="control-group Date row">
									<div class="col-xs-6">
										<div class="panel panel-default room_id">
											<div class="panel-heading">Raum</div>
											<select name="data[Date][room_id]" class="form-control panel-body" style="padding:0px;">
												<?php foreach($rooms as $id => $name) {
													echo '<option value="'.$id.'" '.(($id == $date['Date']['room_id'])?'selected="selected"':'').'>'.$name.'</option>';
												} ?>
											</select>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="panel panel-default director">
											<div class="panel-heading">Trainer</div>
											<select name="data[Date][director]" class="form-control panel-body" style="padding:0px;">
												<?php foreach($directors as $director) {
													echo '<option value="'.$director['Account']['id'].'" '.(($director['Account']['id'] == $date['Date']['director'])?'selected="selected"':'').'>'.$director['Person']['surname'].' '.$director['Person']['name'].' ('.$director['Account']['username'].')</option>';
												} ?>
											</select>
										</div>
									</div>
								</div>
								<div class="control-group Date row">
									<div class="col-xs-6">
										<div class="panel panel-default begin">
											<div class="panel-heading">Beginn</div>
											<div class="input-group input-append date">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-calendar"></i>
												</span>
												<input type="text" name="data[Date][begin]" class="form-control" value="<?php echo $date['Date']['begin'];?>">
												<span class="input-group-addon" onclick="$(this).parent().children('.form-control').val('');">
													<i class="glyphicon glyphicon-remove-circle"></i>
												</span>
											</div>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="panel panel-default end">
											<div class="panel-heading">Ende</div>
											<div class="input-group input-append date">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-calendar"></i>
												</span>
												<input type="text" name="data[Date][end]" class="form-control" value="<?php echo $date['Date']['end'];?>">
												<span class="input-group-addon" onclick="$(this).parent().children('.form-control').val('');">
													<i class="glyphicon glyphicon-remove-circle"></i>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="control-group Date row">
									<div class="col-xs-6">
										<div class="panel panel-default mincount">
											<div class="panel-heading">Minimale Teilnehmerzahl</div>
											<input type="input" class="form-control panel-body" name="data[Date][mincount]" value="<?php echo $date['Date']['mincount'];?>" placeholder="Minimale Teilnehmerzahl">
										</div>
									</div>
									<div class="col-xs-6">
										<div class="panel panel-default maxcount">
											<div class="panel-heading">Maximale Teilnehmerzahl</div>
											<input type="input" class="form-control panel-body" name="data[Date][maxcount]" value="<?php echo $date['Date']['maxcount'];?>" placeholder="Maximale Teilnehmerzahl">
										</div>
									</div>
								</div>
							</form>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="dateEditTeilnehmer" style="height:300px;overflow: scroll">
							<table class="table">
								<thead>
								<tr>
									<th>Name</th>
									<th>Username</th>
									<th>Aktion</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach($accounts as $account)
								{
									$accountSignedUp = false;
									foreach($date['Account'] as $signedUpUser) {
										if($signedUpUser['id'] == $account['Account']['id']) {$accountSignedUp = true; }
									}

									echo '<tr>';
									echo '<td>'.$account['Person']['surname'].' '.$account['Person']['name'].'</td>';
									echo '<td>'.$account['Account']['username'].'</td><td>';
									if(!$accountSignedUp) {
										if(count($date['Account']) < $date['Date']['maxcount']) {
											echo '<button type="button" class="btn btn-default" onclick="dateSignUpUser('.$date['Date']['id'].', \''.$this->webroot.'dates/signupUser/\', '.$account['Account']['id'].');$(this).remove();">Anmelden</button>';
										} else {
											echo '<button type="button" class="btn btn-default">Voll</button>';
										}
									} else {
										echo '<button type="button" class="btn btn-default" onclick="dateSignOffUser('.$date['Date']['id'].', \''.$this->webroot.'dates/signoffUser/\', '.$account['Account']['id'].');$(this).remove();">Abmelden</button>';
									}
									echo '</td><td></td>';
									echo '</tr>';
								}

								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
					<button type="button" id="dateEditSubmitButton" class="btn btn-primary" onclick="$('#dateEditForm').submit();">Kursdaten speichern</button>
				</div>
			</div>
		</div>
		<?php echo $this->Html->scriptStart(array('inline' => true));?>
		$('.modal').on('hidden.bs.modal', function (e) {
			$('.modal').remove();
			$('.bootstrap-datetimepicker-widget').remove();
		});
		$(function() {
			$("#dateEditForm > .Date > .col-xs-6 > .begin > .date > .form-control").datetimepicker({
				language: 'de'
			});
			$("#dateEditForm > .Date > .col-xs-6 > .end > .date > .form-control").datetimepicker({
				language: 'de'
			});
		});
		$('#dateEditTabbar > .nav-tabs a').click(function (e) {
			e.preventDefault();
			if(!$(this).hasClass('active')){
				$(this).tab('show');
				$('#dateEditSubmitButton').toggle();
			}
		});

		dateEditFormAddSubmitEvent('<?php echo $this->webroot;?>', <?php echo $date['Date']['id'];?>, <?php echo $date['Date']['course_id'];?>);
		<?php echo $this->Html->scriptEnd();?>
	</div>
</div>
