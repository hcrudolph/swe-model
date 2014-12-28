<div id="coursePlan">
    <div class="panel panel-default">
        <div class="panel-heading">Daten</div>
        <div class="form-group form-horizontal panel-body">
            <div class="row">
                <div class="col-xs-6">
                    <div class="input-group date">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-calendar"></i>
                        </span>
                        <input type="text" id="coursePlanDateFrom" class="form-control ">
                        <span class="input-group-addon" onclick="$(this).parent().children('.form-control').val('');">
                            <i class="glyphicon glyphicon-remove-circle"></i>
                        </span>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="input-group date">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-calendar"></i>
                        </span>
                        <input type="text" id="coursePlanDateTo" class="form-control ">
                        <span class="input-group-addon" onclick="$(this).parent().children('.form-control').val('');">
                            <i class="glyphicon glyphicon-remove-circle"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <label for="inputEmail" class="control-label col-xs-2">Montag</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control" id="coursePlanMontag" placeholder="h:m-h:m">
                </div>
                <label for="inputEmail" class="control-label col-xs-2">Donnerstag</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control" id="coursePlanDonnerstag" placeholder="h:m-h:m">
                </div>
                <label for="inputEmail" class="control-label col-xs-2">Sonntag</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control" id="coursePlanSonntag" placeholder="h:m-h:m">
                </div>
            </div>
            <div class="row">
                <label for="inputEmail" class="control-label col-xs-2">Dienstag</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control" id="coursePlanDienstag" placeholder="h:m-h:m">
                </div>
                <label for="inputEmail" class="control-label col-xs-2">Freitag</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control" id="coursePlanFreitag" placeholder="h:m-h:m">
                </div>
            </div>
            <div class="row">
                <label for="inputEmail" class="control-label col-xs-2">Mittwoch</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control" id="coursePlanMittwoch" placeholder="h:m-h:m">
                </div>
                <label for="inputEmail" class="control-label col-xs-2">Samstag</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control" id="coursePlanSamstag" placeholder="h:m-h:m">
                </div>
                <div class="col-xs-4">
                    <button type="button" class="btn btn-default" onclick="courseCreateVorlage();">Vorlagen erstellen</button>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Vorlagen</div>
        <table class="table panel-body" id="coursePlanTable">
            <tr>
                <th>Beginn</th>
                <th>Ende</th>
                <th>Trainer</th>
                <th>Raum</th>
                <th>Minimale Teilnehmer</th>
                <th>Maximale Teilnehmer</th>
                <th>Aktionen</th>
            </tr>
        </table>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">Existierende Termine</div>
        <table class="table panel-body" id="courseExistTable">
            <tr>
                <th>Beginn</th>
                <th>Ende</th>
                <th>Trainer</th>
                <th>Raum</th>
                <th>Minimale Teilnehmer</th>
                <th>Maximale Teilnehmer</th>
                <th>Aktionen</th>
            </tr>
            <?php foreach($course['Date'] as $date) {?>
                <tr id="coursePlanExistEntry<?php echo $date['id']; ?>">
                    <td><?php echo $date['begin']; ?></td>
                    <td><?php echo $date['end']; ?></td>
                    <td><?php echo $date['Trainer']['Person']['surname'].' '.$date['Trainer']['Person']['name']; ?></td>
                    <td><?php echo $date['Room']['name']; ?></td>
                    <td><?php echo $date['mincount']; ?></td>
                    <td><?php echo $date['maxcount']; ?></td>
                    <td><button class="btn btn-default" onclick="dateDelete('<?php echo $this->webroot;?>dates/delete/', <?php echo $date['id']; ?>, <?php echo $course['Course']['id']; ?>)"> Absagen</button</td>
                </tr>
            <?php } ?>
        </table>
    </div>


</div>

<?php echo $this->Html->scriptStart(array('inline' => true)); ?>
    $('#coursePlanDateFrom').datepicker({
        format: 'dd.mm.yyyy',
        language: 'de'
    });
    $('#coursePlanDateTo').datepicker({
        format: 'dd.mm.yyyy',
        language: 'de'
    });

$("#courseEntries").on('courseChanged', function(event) {
    $('#coursePlanExistEntry'+event.dateId).remove();
});


function courseCreateVorlage() {
    var from = $('#coursePlanDateFrom').val();
    var to = $('#coursePlanDateTo').val();
    if(from != '' && to != '') {
        var dateFrom = parseDate(from);
        var dateTo = parseDate(to);

        for (var d = dateFrom; d <= dateTo; d.setDate(d.getDate() + 1)) {
            var courseId = <?php echo $course['Course']['id']; ?>;
            var beg = '<td>Beginn</td>';
            var end = '<td>Ende</td>';
            var trainer = '<td>Trainer</td>';
            var raum = '<td>Raum</td>';
            var min = '<td>Min</td>';
            var max = '<td>Max</td>';
            var check = '<td><button class="btn btn-default" onclick="courseAddVorlageEntry('+courseId+','+courseId+','+courseId+','+courseId+','+courseId+','+courseId+','+courseId+')">Validieren</button></td>';
            
            $('#coursePlanTable').append('<tr>'+beg+end+trainer+raum+min+max+check+'</tr>');
        }
    }
}
function parseDate(input) {
var parts = input.match(/(\d+)/g);
return new Date(parts[2], parts[1]-1, parts[0]);
}

function courseAddVorlageEntry(courseId, begin, end, director, room_id, mincount, maxcount) {
    $.post('<?php echo $this->webroot; ?>dates/add/'+courseId, {
        "data[Date][begin]":begin,
        "data[Date][end]": end,
        "data[Date][director]": director,
        "data[Date][room_id]": room_id,
        "data[Date][mincount]": mincount,
        "data[Date][maxcount]": maxcount
    }, function(json){

    });
}
<?php echo $this->Html->scriptEnd();?>
<style>
    .datepicker{z-index:1151 !important;}
</style>


<?php
foreach($course['Date'] as $date)
{
    echo var_dump($date).'<br>';
}



?>

