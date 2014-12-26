<form id="courseAddForm">
    <div class="control-group Course">
        <div class="name">
            <input type="input" class="form-control" placeholder="Name">
        </div>
        <div class="category">
            <input type="input" class="form-control" placeholder="Kategorie">
        </div>
        <div class="description">
            <input type="input" class="form-control" placeholder="Beschreibung">
        </div>
        <button type="submit" class="btn btn-default">Speichern</button>
</form>

<?php echo $this->Html->scriptStart(array('inline' => true)); ?>

$(document).ready(function() {
$('#courseAddForm').submit(function(event) {
$.post('<?php echo $this->webroot;?>courses/add/', $('#courseAddForm').serialize(), function(json) {
if(json.success == true) {
notificatecourse(json.message, 'success');

$.get('<?php echo $this->webroot?>courses/listing/', function( data ) {
$('#courseListing').replaceWith(data);
});
} else {
notificatecourse(json.message);

//delete old errors
$('#courseAddForm').children().each(function() {
$(this).children().each(function() {
$(this).removeClass('has-error has-feedback');
$(this).children('.glyphicon').remove();
$(this).children('.control-label').remove();
});
})

for(var controller in json.errors)
{
for(var key in json.errors[controller])
{
if(json.errors[controller].hasOwnProperty(key))
{
notificatecourse(json.errors[controller][key]);
var ele = $('#courseAddForm > .'+controller+' > .'+key);
ele.addClass('has-error has-feedback');
ele.append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
ele.append('<label class="control-label">'+json.errors[controller][key]+'</label>');
}
}
}
}
}, 'json');
event.preventDefault();
});
});
<?php echo $this->Html->scriptEnd(); ?>