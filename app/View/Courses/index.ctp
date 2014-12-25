<div class="panel-group" id="courseEntries" role="tablist" aria-multiselectable="true">
	<?php
	foreach($courses as $course) {
		$courseId = $course['Course']['id'];
		?>

		<div class="panel panel-default" id="courseEntry<?php echo $courseId; ?>">
			<div class="panel-heading clearfix" role="tab" id="courseEntryHeading<?php echo $courseId; ?>">
				<h4 class="panel-title pull-left">
					<a data-toggle="collapse" data-parent="#courseEntries" data-url="<?php echo $this->webroot;?>courses/view/<?php echo $courseId; ?>" href="#courseEntryCollapse<?php echo $courseId;?>" aria-expanded="false" aria-controls="courseEntryCollapse<?php echo $courseId; ?>">
						<?php echo h($course['Course']['name']); ?>
					</a>
				</h4>
				<?php if(isset($user) AND $user['role'] > 0) {?>
					<div class="btn-group pull-right">
						<a class="btn btn-default btn-sm" href="javascript:void(0)" onclick="courseEdit(<?php echo $courseId; ?>);">Bearbeiten</a>
						<a class="btn btn-default btn-sm" href="javascript:void(0)" onclick="courseDelete(<?php echo $courseId; ?>);">Löschen</a>
					</div>
				<?php } ?>
			</div>
			<div id="courseEntryCollapse<?php echo $courseId;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="courseEntryHeading<?php echo $courseId; ?>">
				<div class="panel-body"></div>
			</div>
		</div>
	<?php } ?>
</div>


<?php echo $this->Html->scriptStart(array('inline' => true));?>
	$('#courseEntries > .panel > .panel-heading a').click(function (e) {
		e.preventDefault();

		var url = $(this).attr("data-url");
		var href = this.hash;
		var pane = $(this);

		// ajax load from data-url
		$(href+' > .panel-body').load(url,function(result){
			pane.tab('show');
		});
	});

	function courseDelete(courseId)
	{
		alert('Delete Course');
	}

	function courseEdit(courseId)
	{
		alert('Edit Course');
	}

	function courseDateEdit(dateId)
	{
		alert('Bearbeiten: '+dateId);
	}


	function courseDateSignUpUser(dateId) {
		$.post('<?php echo $this->webroot."dates/signupUser/"?>'+dateId,function(json) {
			if(json.success == true) {
				notificateUser(json.message, 'success');
				//$('#postEntry'+postId).remove();
				//Toggle Buttons
			} else {
				notificateUser(json.message, json.error);
			}
		}, 'json');
	}

	function courseDateSignOffUser(dateId) {
		$.post('<?php echo $this->webroot."dates/signoffUser/"?>'+dateId,function(json) {
			if(json.success == true) {
				notificateUser(json.message, 'success');
				//$('#postEntry'+postId).remove();
				//Toggle Buttons
			} else {
				notificateUser(json.message, json.error);
			}
		}, 'json');
	}
<?php echo $this->Html->scriptEnd();?>