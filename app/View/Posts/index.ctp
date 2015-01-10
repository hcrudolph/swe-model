<?php
if(!empty($user) AND $user['role'] > 0) { ?>
    <button type="button" class="btn btn-default" onclick="postsAddButtonClick();"><i class="glyphicon glyphicon-plus"></i>Hinzufügen</button>
<?php } ?>

<div id="postEntries">
    <?php
    foreach ($posts as $post)
    {
        echo $this->element('post', array('post' => $post));
    }
    ?>
</div>
<nav>
    <ul class="pagination">
        <?php
        for($i=0;$i<=$postCount;$i=$i+$limit)
        {
            if ($postCount > 5) {
                echo '<li ' . (($page == $i / $limit) ? 'class="active"' : '') . '><a href="javascript:void(0);" onclick="loadPage(' . ($i / $limit) . ')">' . (($i / $limit) + 1) . '<span class="sr-only">(current)</span></a></li>';
            }
            else if ($postCount == 0) {
                echo '<span class="label label-info">Es sind keine Einträge vorhanden.</span>';
            }
         }
        ?>
    </ul>
</nav>
<?php echo $this->Html->scriptStart(array('inline' => true)); ?>

function loadPage(page) {
    $('#content').load('<?php echo $this->webroot."posts/index/";?>'+page);
}

function postsAddButtonClick()
{
    $.get('<?php echo $this->webroot;?>posts/add/', function( view ) {
        $('body').append(view);
        $('body > .modal').modal('show');
    });
}


function postEntryDelete(postId)
{
    var del = confirm("Post #" + postId + " löschen?");
    if (del == true) {
        $.post('<?php echo $this->webroot."posts/delete/"?>'+postId,function(json) {
            if(json.success == true)
            {
                notificateUser(json.message, 'success');
                $('#postEntry'+postId).remove();
            } else
            {
                notificateUser(json.message);
            }
        }, 'json');
    }
}

function postEntryEdit(postId)
{
    $.get('<?php echo $this->webroot."posts/edit/"?>'+postId, function( view ) {
        $('body').append(view);
        $('body > .modal').modal('show');
    });
}


function postAddFormAddDatepicker()
{
    $("#postAddForm > .Post > div > .visiblebegin > .date > .form-control").datepicker({
        format: 'dd.mm.yyyy',
        language: 'de'
    });
    $("#postAddForm > .Post > div > .visibleend > .date > .form-control").datepicker({
        format: 'dd.mm.yyyy',
        language: 'de'
    });
}

function postAddFormAddSubmitEvent()
{
    var addForm = '#postAddForm';
    $(addForm).submit(function(event) {
        $.post('<?php echo $this->webroot;?>posts/add/', $(addForm).serialize(), function(json) {
            if(json.success == true) {
                notificateUser(json.message, 'success');
                $.get('<?php echo $this->webroot;?>posts/view/'+json.id, function( view ) {
                    $('#postEntries').prepend(view);
                    $('.modal').modal('hide');
                });
            } else {
                notificateUser(json.message);

                //delete old errors
                $(addForm).children().each(function() {
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
                            var ele = $(addForm+' > .'+controller+' > div > .'+key);
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


function postEditFormAddDatepicker()
{
    $("#postEditForm > .Post > div > .visiblebegin > .date > .form-control").datepicker({
        format: 'dd.mm.yyyy',
        language: 'de'
    });
    $("#postEditForm > .Post > div > .visibleend > .date > .form-control").datepicker({
        format: 'dd.mm.yyyy',
        language: 'de'
    });
}

function postEditFormAddSubmitEvent(postId)
{
    var editForm = '#postEditForm';
    $(editForm).submit(function(event) {
        $.post('<?php echo $this->webroot;?>posts/edit/'+postId, $(editForm).serialize(), function(json) {
            if(json.success == true) {
                notificateUser(json.message, 'success');
                $('.modal').modal('hide');
                $.get('<?php echo $this->webroot;?>posts/view/'+postId, function( view ) {
                    $('#postEntry'+postId).replaceWith(view);
                });
            } else {
            notificateUser(json.message);

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
