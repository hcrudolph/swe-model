<div class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Kurs bearbeiten</h4>
			</div>
			<div class="modal-body">
				<form id="courseEditForm<?php echo $course['Course']['id'];?>">
					<div class="control-group Course row">
						<div class="col-xs-12">
							<div class="panel panel-default name">
								<div class="panel-heading">Kursname</div>
								<input type="input" class="form-control panel-body" name="data[Course][name]" value="<?php echo $course['Course']['name'];?>" placeholder="Kursname">
							</div>
						</div>
						<div class="col-xs-12">
							<div class="panel panel-default description">
								<div class="panel-heading">Beschreibung</div>
								<textarea name="data[Course][description]" class="body form-control panel-body" rows="3" placeholder="Kursbeschreibung"><?php echo $course['Course']['description'];?></textarea>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="panel panel-default mincount">
								<div class="panel-heading">Minimale Teilnehmeranzahl</div>
								<input type="input" class="form-control panel-body" name="data[Course][mincount]" value="<?php echo $course['Course']['mincount'];?>" placeholder="Minimale Teilnehmerzahl">
							</div>
						</div>
						<div class="col-xs-6">
							<div class="panel panel-default maxcount">
								<div class="panel-heading">Maximale Teilnehmeranzahl</div>
								<input type="input" class="form-control panel-body" name="data[Course][maxcount]" value="<?php echo $course['Course']['maxcount'];?>" placeholder="Maximale Teilnehmerzahl">
							</div>
						</div>
					</div>
				</form>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
				<button type="button" class="btn btn-primary" onclick="$('#courseEditForm<?php echo $course['Course']['id'];?>').submit();">Speichern</button>
			</div>
		</div>
	</div>
	<?php echo $this->Html->scriptStart(array('inline' => true));?>
		$('.modal').on('hidden.bs.modal', function (e) {
			$('.modal').remove();
		});
		courseEditFormAddSubmitEvent(<?php echo $course['Course']['id'];?>);
	<?php echo $this->Html->scriptEnd();?>
</div>