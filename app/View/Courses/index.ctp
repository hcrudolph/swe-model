<div id="courseEntries" role="tablist" aria-multiselectable="true">
	<?php
	foreach($courses as $course) {
		echo $this->element('courseIndexElement', array('course' =>$course));
	} ?>
</div>


<?php echo $this->Html->scriptStart(array('inline' => true));?>
collapseAddHandler();

function collapseAddHandler() {
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
}

	function courseDelete(courseId) {
		alert('Delete Course');
	}

	function courseEdit(courseId) {
		$.get('<?php echo $this->webroot?>Courses/edit/'+courseId,function(html) {
			$('body').append(html);
			$('body > .modal').modal('show');
		});
	}

	function courseDateEdit(dateId) {
		alert('Bearbeiten: '+dateId);
	}

	function courseDateAdd(courseId) {
		$.get('<?php echo $this->webroot?>Courses/addDate/'+courseId,function(html) {
			$('body').append(html);
			$('body > .modal').modal('show');
		});
	}

	function courseDateDelete(dateId) {
		$.post('<?php echo $this->webroot."dates/delete/"?>'+dateId,function(json) {
			if(json.success == true) {
				notificateUser(json.message, 'success');
				//Alle user benachrichtigt?
			} else {
				notificateUser(json.message, json.error);
			}
		}, 'json');
	}


	function courseDateSignUpUser(courseId, dateId) {
		$.post('<?php echo $this->webroot."dates/signupUser/"?>'+dateId,function(json) {
			if(json.success == true) {
				notificateUser(json.message, 'success');
				//Toggle Buttons
			} else {
				notificateUser(json.message, json.error);
			}
		}, 'json');
	}

	function courseDateSignOffUser(courseId, dateId) {
		$.post('<?php echo $this->webroot."dates/signoffUser/"?>'+dateId,function(json) {
			if(json.success == true) {
				notificateUser(json.message, 'success');
				//Toggle Buttons
			} else {
				notificateUser(json.message, json.error);
			}
		}, 'json');
	}


function courseEditFormAddSubmitEvent(courseId) {
	var editForm = '#courseEditForm'+courseId;
	$(editForm).submit(function(event) {
		$.post('<?php echo $this->webroot;?>Courses/edit/'+courseId, $(editForm).serialize(), function(json) {
			if(json.success == true) {
				notificateUser(json.message, 'success');
				$.get('<?php echo $this->webroot?>Courses/indexElement/'+courseId, function(view) {
					$('#courseIndexEntry'+courseId).replaceWith(view);
				});
				$('.modal').modal('hide');
			} else {
				notificateUser(json.message);

				//delete old errors
				$(editForm).children().each(function() {
					$(this).children().each(function() {
						$(this).children('div').each(function() {
							$(this).addClass('panel-default').removeClass('panel-danger has-error');
							$(this).children('.panel-footer').remove();
						});
					});
				});

				for(var controller in json.errors) {
					for(var key in json.errors[controller]) {
						if(json.errors[controller].hasOwnProperty(key)) {
						notificateUser(json.errors[controller][key]);
						var ele = $(editForm+' > .'+controller+' > div > .'+key);
						ele.addClass('panel-danger has-error');
						ele.append('<div class="panel-footer">'+json.errors[controller][key]+'</div>');
						}
					}
				}
			}
		}, 'json');
		event.preventDefault();
	});
}

function courseAddDateFormAddSubmitEvent(courseId) {
	var addDateForm = '#courseAddDateForm'+courseId;
	$(addDateForm).submit(function(event) {
		$.post('<?php echo $this->webroot;?>Courses/edit/'+courseId, $(addDateForm).serialize(), function(json) {
			if(json.success == true) {
				notificateUser(json.message, 'success');
				//$.get('<?php echo $this->webroot?>Courses/indexElement/'+courseId, function(view) {
				//$('#courseIndexEntry'+courseId).replaceWith(view);
				//});
				$('.modal').modal('hide');
			} else {
			notificateUser(json.message);

			//delete old errors
			$(addDateForm).children().each(function() {
				$(this).children().each(function() {
					$(this).children('div').each(function() {
						$(this).addClass('panel-default').removeClass('panel-danger has-error');
						$(this).children('.panel-footer').remove();
					});
				});
			});

			for(var controller in json.errors) {
				for(var key in json.errors[controller]) {
					if(json.errors[controller].hasOwnProperty(key)) {
						notificateUser(json.errors[controller][key]);
						var ele = $(addDateForm+' > .'+controller+' > div > .'+key);
						ele.addClass('panel-danger has-error');
						ele.append('<div class="panel-footer">'+json.errors[controller][key]+'</div>');
					}
					}
				}
			}
		}, 'json');
		event.preventDefault();
	});
}
<?php echo $this->Html->scriptEnd();?>