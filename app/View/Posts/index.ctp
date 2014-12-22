<?php
if(!empty($user))
{?>
    <button type="button" id="userAddOpenButton" class="btn btn-default" onclick="postsAddButtonClick();"><i class="glyphicon glyphicon-plus"></i>Hinzufügen</button>
<?php
}
echo $this->Html->scriptStart(array('inline' => true));
?>
var addId = 0;
function postsAddButtonClick()
{
    $.get('<?php echo $this->webroot."posts/add/";?>'+addId, function( data ) {
        $('#postEntries').before(data);
    });
    addId++;
}
<?php echo $this->Html->scriptEnd();?>

<div id="postEntries">
    <?php
    foreach ($posts as $post)
    {
        echo $this->element('post', array('post' => $post));
    }
    ?>
</div>
<?php echo $this->Html->scriptStart(array('inline' => true)); ?>
function postEntryDelete(id)
{
    var del = confirm("Post #" + id + " löschen?");
    if (del == true) {
        $.post('<?php echo $this->webroot."posts/delete/"?>'+id,function(json) {
            if(json.success == true)
            {
                notificateUser(json.message, 'success');
                $('#postEntry'+id).remove();
            } else
            {
                notificateUser(json.message);
            }
        }, 'json');
    }
}

function postEntryEdit(id)
{
    $.get('<?php echo $this->webroot."posts/edit/"?>'+id, function( data ) {
        $('#postEntry'+id).replaceWith(data);
    });
}

function postAddFormClose(addId)
{
    $('#postAddForm'+addId).remove();
}

function postAddFormAddDatepicker(addId)
{
    $("#postAddForm"+addId+" > .Post > .visiblebegin > .date > .form-control").datepicker({
        format: 'dd.mm.yyyy',
        language: 'de'
    });
    $("#postAddForm"+addId+" > .Post > .visibleend > .date > .form-control").datepicker({
        format: 'dd.mm.yyyy',
        language: 'de'
    });
}

function postAddFormAddSubmitEvent(addId)
{
    var addForm = '#postAddForm'+addId;
    $(addForm).submit(function(event) {
        $.post('<?php echo $this->webroot;?>posts/add/', $(addForm).serialize(), function(json) {
            if(json.success == true) {
                notificateUser(json.message, 'success');
                $.get('<?php echo $this->webroot;?>posts/view/'+json.id, function( view ) {
                    $('#postEntries').prepend(view);
                    postAddFormClose(addId);
                });
            } else {
                notificateUser(json.message);

                //delete old errors
                $(addForm).children().each(function() {
                    $(this).children().each(function() {
                        $(this).removeClass('has-error has-feedback');
                        $(this).children('.control-label').remove();
                    });
                })

                for(var controller in json.errors) {
                    for(var key in json.errors[controller]) {
                        if(json.errors[controller].hasOwnProperty(key)) {
                            notificateUser(json.errors[controller][key]);
                            var ele = $(addForm+' > .'+controller+' > .'+key);
                            ele.addClass('has-error has-feedback');
                            ele.append('<label class="control-label">'+json.errors[controller][key]+'</label>');
                        }
                    }
                }
            }
        }, 'json');
        event.preventDefault();
    });
}


function postEditFormAddDatepicker(postId)
{
    $("#postEditForm"+postId+" > .Post > .visiblebegin > .date > .form-control").datepicker({
        format: 'dd.mm.yyyy',
        language: 'de'
    });
    $("#postEditForm"+postId+" > .Post > .visibleend > .date > .form-control").datepicker({
        format: 'dd.mm.yyyy',
        language: 'de'
    });
}

function postEditFormAddSubmitEvent(postId)
{
    var editForm = '#postEditForm'+postId;
    $(editForm).submit(function(event) {
        $.post('<?php echo $this->webroot;?>posts/edit/'+postId, $(editForm).serialize(), function(json) {
            if(json.success == true) {
                notificateUser(json.message, 'success');
                $.get('<?php echo $this->webroot;?>posts/view/'+postId, function( view ) {
                    $(editForm).replaceWith(view);
                });
            } else {
            notificateUser(json.message);

            //delete old errors
            $(editForm).children().each(function() {
                $(this).children().each(function() {
                    $(this).removeClass('has-error has-feedback');
                    $(this).children('.control-label').remove();
                });
            })

            for(var controller in json.errors) {
                for(var key in json.errors[controller]) {
                    if(json.errors[controller].hasOwnProperty(key)) {
                        notificateUser(json.errors[controller][key]);
                        var ele = $(editForm+' > .'+controller+' > .'+key);
                        ele.addClass('has-error has-feedback');
                        ele.append('<label class="control-label">'+json.errors[controller][key]+'</label>');
                    }
                }
            }
        }
    }, 'json');
    event.preventDefault();
    });
}




function postEditFormClose(postId)
{
    $.get('<?php echo $this->webroot."posts/view/"?>'+postId, function( data ) {
        $('#postEditForm'+postId).replaceWith(data);
    });
}
<?php echo $this->Html->scriptEnd();?>
