<div class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Termin erstellen</h4>
			</div>
			<div class="modal-body">
				<form id="dateAddForm">
					<div class="control-group Date row">
						<div class="col-xs-12">
							<div class="panel panel-default course_id">
								<div class="panel-heading">Kurs</div>
								<select name="data[Date][course_id]" class="form-control panel-body" style="padding:0px;">
									<?php foreach($courses as $course) {
										echo '<option value="'.$course['Course']['id'].'">'.$course['Course']['name'].' (Schwierigkeit: '.$course['Course']['level'].')</option>';
									} ?>
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
										echo '<option value="'.$id.'">'.$name.'</option>';
									} ?>
								</select>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="panel panel-default director">
								<div class="panel-heading">Trainer</div>
								<select name="data[Date][director]" class="form-control panel-body" style="padding:0px;">
									<?php foreach($directors as $director) {
										echo '<option value="'.$director['Account']['id'].'">'.$director['Person']['surname'].' '.$director['Person']['name'].' ('.$director['Account']['username'].')</option>';
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
									<input type="text" name="data[Date][begin]" class="form-control">
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
									<input type="text" name="data[Date][end]" class="form-control">
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
								<input type="input" class="form-control panel-body" name="data[Date][mincount]" placeholder="Minimale Teilnehmerzahl">
							</div>
						</div>
						<div class="col-xs-6">
							<div class="panel panel-default maxcount">
								<div class="panel-heading">Maximale Teilnehmerzahl</div>
								<input type="input" class="form-control panel-body" name="data[Date][maxcount]" placeholder="Maximale Teilnehmerzahl">
							</div>
						</div>
					</div>
				</form>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
					<button type="button" class="btn btn-primary" onclick="$('#dateAddForm').submit();">Speichern</button>
				</div>
			</div>
		</div>
		<?php echo $this->Html->scriptStart(array('inline' => true));?>
			$('.modal').on('hidden.bs.modal', function (e) {
				$('.modal').remove();
				$('.bootstrap-datetimepicker-widget').remove();
			});
			$(function() {
				$("#dateAddForm > .Date > .col-xs-6 > .begin > .date > .form-control").datetimepicker({
					language: 'de'
				});
				$("#dateAddForm > .Date > .col-xs-6 > .end > .date > .form-control").datetimepicker({
					language: 'de'
				});
			});

			dateAddFormAddSubmitEvent(<?php echo $this->webroot;?><?php echo ((isset($courseId))?', '.$courseId:'');?>);
		<?php echo $this->Html->scriptEnd();?>
	</div>
</div>