<div class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('.modal').remove();"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Kurs bearbeiten</h4>
			</div>
			<div class="modal-body">
				<p>One fine body&hellip;</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" onclick="$('.modal').remove();">Close</button>
				<button type="button" class="btn btn-primary" onclick="courseEditSave(<?php echo $course['Course']['id'];?>)">Save changes</button>
			</div>
		</div>
	</div>
</div>