<?php if(!empty($user) AND $user['role'] > 0) { ?>
    <button type="button" id="userAddOpenButton" class="btn btn-default" onclick="certificateAddButtonClick();"><i class="glyphicon glyphicon-plus"></i>Hinzufügen</button>
<?php } ?>
    <div id="certificateEntries" role="tablist" aria-multiselectable="true">
        <?php
        foreach($certificates as $certificate) {
            echo $this->element('certificateIndexElement', array('certificate' =>$certificate));
        } ?>
    </div>


<?php echo $this->Html->scriptStart(array('inline' => true));?>
    $("#certificateEntries").on('certificateChanged', function(event) {
    var contentShown = false;
    if($('#certificateIndexEntryCollapse'+event.certificateId).hasClass('active')) {
    contentShown = true;
    }
    $.get('<?php echo $this->webroot?>certificates/indexElement/'+event.certificateId, function(view) {
    if($('#certificateIndexEntry'+event.certificateId).length) {
    $('#certificateIndexEntry'+event.certificateId).replaceWith(view);
    } else {
    $('#certificateEntries').prepend(view);
    }
    if(contentShown)
    {
    $('#certificateIndexEntryHeading'+event.certificateId+' > .panel-title  a').trigger("click");
    }
    });
    });


    $('#certificateEntries > .panel > .panel-heading > .panel-title a').click(function (e) {
    e.preventDefault();

    var url = $(this).attr("data-url");
    var href = this.hash;
    var pane = $(this);

    // ajax load from data-url
    $(href+' > .panel-body').load(url,function(result){
    pane.tab('show');
    });
    });

    function certificateDelete(certificateId) {
    var del = confirm("Kurs #" + certificateId + " löschen?");
    if (del == true) {
    $.post('<?php echo $this->webroot;?>certificates/delete/'+ certificateId, function (json) {
    if (json.success == true) {
    notificateUser(json.message, 'success');
    $( "#certificateIndexEntry"+certificateId ).remove();
    } else {
    notificateUser(json.message, json.error);
    }
    }, 'json');
    }
    }

    function certificateEdit(certificateId) {
    $.get('<?php echo $this->webroot?>certificates/edit/'+certificateId,function(html) {
    $('body').append(html);
    $('body > .modal').modal('show');
    });
    }

    function certificateAddButtonClick() {
    $.get('<?php echo $this->webroot?>certificates/add/',function(html) {
    $('body').append(html);
    $('body > .modal').modal('show');
    });
    }

    function certificateEditFormAddSubmitEvent(certificateId) {
    var editForm = '#certificateEditForm'+certificateId;
    $(editForm).submit(function(event) {
    $.post('<?php echo $this->webroot;?>certificates/edit/'+certificateId, $(editForm).serialize(), function(json) {
    if(json.success == true) {
    notificateUser(json.message, 'success');
    $('.modal').modal('hide');
    $( "#certificateEntries" ).trigger({
    type:"certificateChanged",
    certificateId:certificateId
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