<div class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Kurs bearbeiten</h4>
			</div>
			<div class="modal-body">
				<div id="courseEditTabbar" role="tabpanel">
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#courseEditData">Kursdaten</a></li>
						<li role="presentation"><a href="#courseEditPlanner">Terminplaner</a></li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="courseEditData">
							<form id="courseEditForm<?php echo $course['Course']['id'];?>">
								<div class="control-group Course row">
									<div class="col-xs-6">
										<div class="panel panel-default name">
											<div class="panel-heading">Kursname</div>
											<input type="input" class="form-control panel-body" name="data[Course][name]" value="<?php echo $course['Course']['name'];?>" placeholder="Kursname">
										</div>
									</div>
									<div class="col-xs-6">
										<div class="panel panel-default level">
											<div class="panel-heading">Schwierigkeitsgrad</div>
											<input type="input" class="form-control panel-body" name="data[Course][level]" value="<?php echo $course['Course']['level'];?>" placeholder="Schwierigkeitsgrad">
										</div>
									</div>
									<div class="col-xs-12">
										<div class="panel panel-default description">
											<div class="panel-heading">Beschreibung</div>
											<textarea name="data[Course][description]" class="body form-control panel-body" rows="3" placeholder="Kursbeschreibung"><?php echo $course['Course']['description'];?></textarea>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="courseEditPlanner"></div>
					</div>
				</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
				<button type="button" class="btn btn-primary" onclick="$('#courseEditForm<?php echo $course['Course']['id'];?>').submit();">Speichern</button>
			</div>
		</div>
	</div>
	<?php echo $this->Html->scriptStart(array('inline' => true));?>
		$('#courseEditPlanner').load("<?php echo $this->webroot;?>Courses/plan/<?php echo $course['Course']['id'];?>");

		$('#courseEditTabbar > .nav-tabs a').click(function (e) {
			e.preventDefault();
			$(this).tab('show');
		});
		$('.modal').on('hidden.bs.modal', function (e) {
			$('.modal').remove();
			$('.bootstrap-datetimepicker-widget').remove();
		});
		courseEditFormAddSubmitEvent(<?php echo $course['Course']['id'];?>);
	<?php echo $this->Html->scriptEnd();?>
</div>