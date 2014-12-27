<form id="tariffAddForm">
    <div class="control-group tariff">
        <div class="name">
            <input type="input" class="form-control" placeholder="Name">
        </div>
        <div class="description">
            <input type="input" class="form-control" placeholder="Beschreibung">
        </div>
        <div class="discount">
            <input type="input" class="form-control" placeholder="Rabatt">
        </div>
        <button type="submit" class="btn btn-default">Speichern</button>
</form>

<?php echo $this->Html->scriptStart(array('inline' => true)); ?>

$(document).ready(function() {
$('#tariffAddForm').submit(function(event) {
$.post('<?php echo $this->webroot;?>tariffs/add/', $('#tariffAddForm').serialize(), function(json) {
if(json.success == true) {
notificatetariff(json.message, 'success');

$.get('<?php echo $this->webroot?>tariffs/listing/', function( data ) {
$('#tariffListing').replaceWith(data);
});
} else {
notificatetariff(json.message);

//delete old errors
$('#tariffAddForm').children().each(function() {
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
notificatetariff(json.errors[controller][key]);
var ele = $('#tariffAddForm > .'+controller+' > .'+key);
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