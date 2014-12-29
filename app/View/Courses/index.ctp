<div id="courseEntries" role="tablist" aria-multiselectable="true">
	<?php
	foreach($courses as $course) {
		echo $this->element('courseIndexElement', array('course' =>$course));
	} ?>
</div>


<?php echo $this->Html->scriptStart(array('inline' => true));?>
$("#courseEntries").on('courseChanged', function(event) {
	var contentShown = false;
	if($('#courseIndexEntryCollapse'+event.courseId).hasClass('active')) {
		contentShown = true;
	}
	$.get('<?php echo $this->webroot?>Courses/indexElement/'+event.courseId, function(view) {
		$('#courseIndexEntry'+event.courseId).replaceWith(view);
		if(contentShown)
		{
			$('#courseIndexEntryHeading'+event.courseId+' > .panel-title  a').trigger("click");
		}
	});
});


	$('#courseEntries > .panel > .panel-heading > .panel-title a').click(function (e) {
		e.preventDefault();

		var url = $(this).attr("data-url");
		var href = this.hash;
		var pane = $(this);

		// ajax load from data-url
		$(href+' > .panel-body').load(url,function(result){
			pane.tab('show');
		});
	});

	function courseDelete(courseId) {
		alert('Delete Course');
	}

	function courseEdit(courseId) {
		$.get('<?php echo $this->webroot?>Courses/edit/'+courseId,function(html) {
			$('body').append(html);
			$('body > .modal').modal('show');
		});
	}


function courseEditFormAddSubmitEvent(courseId) {
	var editForm = '#courseEditForm'+courseId;
	$(editForm).submit(function(event) {
		$.post('<?php echo $this->webroot;?>Courses/edit/'+courseId, $(editForm).serialize(), function(json) {
			if(json.success == true) {
				notificateUser(json.message, 'success');
				$('.modal').modal('hide');
				$( "#courseEntries" ).trigger({
					type:"courseChanged",
					courseId:courseId
				});
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
<?php echo $this->Html->scriptEnd();?>