<div id="coursePlan">
    <div class="panel panel-default">
        <div class="panel-heading">Daten</div>
        <div class="form-group form-horizontal panel-body">
            <div class="row">
                <div class="col-xs-4">
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
                <div class="col-xs-4">
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
                <div class="col-xs-12" style="padding-top:10px;padding-bottom:10px">
                    <div style="border-bottom: 1px solid #e5e5e5;"></div>
                </div>
            </div>
            <div class="row">
                <label for="inputEmail" class="control-label col-xs-2">Montag</label>
                <div class="col-xs-2">
                    <div class="btn-group">
                        <input type="text" class="form-control timepicker" id="coursePlanMontagVon" placeholder="hh:mm">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </div>
                    <div class="btn-group">
                        <input type="text" class="form-control timepicker" id="coursePlanMontagBis" placeholder="hh:mm">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </div>
                </div>
                <label for="inputEmail" class="control-label col-xs-2">Freitag</label>
                <div class="col-xs-2">
                    <div class="btn-group">
                        <input type="text" class="form-control timepicker" id="coursePlanFreitagVon" placeholder="hh:mm">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </div>
                    <div class="btn-group">
                        <input type="text" class="form-control timepicker" id="coursePlanFreitagBis" placeholder="hh:mm">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </div>
                </div>
                <label for="inputEmail" class="control-label col-xs-1">Raum</label>
                <div class="col-xs-3">
                    <select id="coursePlanRoom" class="form-control">
                        <?php foreach($rooms as $id => $name) {
                            echo '<option value="'.$id.'">'.$name.'</option>';
                        } ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12" style="padding-top:10px;padding-bottom:10px">
                    <div style="border-bottom: 1px solid #e5e5e5;"></div>
                </div>
            </div>
            <div class="row">
                <label for="inputEmail" class="control-label col-xs-2">Dienstag</label>
                <div class="col-xs-2">
                    <div class="btn-group">
                        <input type="text" class="form-control timepicker" id="coursePlanDienstagVon" placeholder="hh:mm">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </div>
                    <div class="btn-group">
                        <input type="text" class="form-control timepicker" id="coursePlanDienstagBis" placeholder="hh:mm">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </div>
                </div>
                <label for="inputEmail" class="control-label col-xs-2">Samstag</label>
                <div class="col-xs-2">
                    <div class="btn-group">
                        <input type="text" class="form-control timepicker" id="coursePlanSamstagVon" placeholder="hh:mm">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </div>
                    <div class="btn-group">
                        <input type="text" class="form-control timepicker" id="coursePlanSamstagBis" placeholder="hh:mm">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </div>
                </div>
                <label for="inputEmail" class="control-label col-xs-1">Trainer</label>
                <div class="col-xs-3">
                    <select id="coursePlanTrainer" class="form-control">
                        <?php foreach($directors as $director) {
                            echo '<option value="'.$director['Account']['id'].'">'.$director['Person']['surname'].' '.$director['Person']['name'].' ('.$director['Account']['username'].')</option>';
                        } ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12" style="padding-top:10px;padding-bottom:10px">
                    <div style="border-bottom: 1px solid #e5e5e5;"></div>
                </div>
            </div>
            <div class="row">
                <label for="inputEmail" class="control-label col-xs-2">Mittwoch</label>
                <div class="col-xs-2">
                    <div class="btn-group">
                        <input type="text" class="form-control timepicker" id="coursePlanMittwochVon" placeholder="hh:mm">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </div>
                    <div class="btn-group">
                        <input type="text" class="form-control timepicker" id="coursePlanMittwochBis" placeholder="hh:mm">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </div>
                </div>
                <label for="inputEmail" class="control-label col-xs-2">Sonntag</label>
                <div class="col-xs-2">
                    <div class="btn-group">
                        <input type="text" class="form-control timepicker" id="coursePlanSonntagVon" placeholder="hh:mm">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </div>
                    <div class="btn-group">
                        <input type="text" class="form-control timepicker" id="coursePlanSonntagBis" placeholder="hh:mm">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="row">
                        <label for="inputEmail" class="control-label col-xs-6">Min.Teilnehmer</label>
                        <div class="col-xs-6">
                            <input type="text" class="form-control" id="coursePlanTeilnehmerMin" placeholder="min">
                        </div>
                    </div>
                    <div class="row">
                        <label for="inputEmail" class="control-label col-xs-6">Max.Teilnehmer</label>
                        <div class="col-xs-6">
                            <input type="text" class="form-control" id="coursePlanTeilnehmerMax" placeholder="max">
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-xs-12" style="padding-top:10px;padding-bottom:10px">
                    <div style="border-bottom: 1px solid #e5e5e5;"></div>
                </div>
            </div>
            <div class="row">
                <label for="inputEmail" class="control-label col-xs-2">Donnerstag</label>
                <div class="col-xs-2">
                    <div class="btn-group">
                        <input type="text" class="form-control timepicker" id="coursePlanDonnerstagVon" placeholder="hh:mm">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </div>
                    <div class="btn-group">
                        <input type="text" class="form-control timepicker" id="coursePlanDonnerstagBis" placeholder="hh:mm">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </div>
                </div>
                <div class="col-xs-5"></div>
                <div class="col-xs-3">
                    <button type="button" class="btn btn-primary" onclick="courseCreateVorlage();">Vorlagen erstellen</button>
                </div>

            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">Vorlagen</div>
        <table class="table table-bordered panel-body" id="coursePlanTable">
            <thead>
                <tr>
                    <th>Beginn</th>
                    <th>Ende</th>
                    <th>Trainer</th>
                    <th>Raum</th>
                    <th>Minimale Teilnehmer</th>
                    <th>Maximale Teilnehmer</th>
                    <th>Aktionen</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">Existierende Termine</div>
        <table class="table table-bordered panel-body" id="courseExistTable">
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
                    <td><button class="btn btn-default" onclick="dateDelete('<?php echo $this->webroot;?>dates/delete/', <?php echo $date['id']; ?>, <?php echo $course['Course']['id']; ?>)">Absagen</button</td>
                </tr>
            <?php } ?>
        </table>
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

    $('span.glyphicon-remove-circle').click(function() {
        $(this).parent().children('.form-control').val('');
    });

    $('.timepicker').datetimepicker({
        language: 'de',
        pickDate: false,
        pickTime: true,
    });

    var planId = 0;

    function courseCreateVorlage() {
        var room = $('#coursePlanRoom').children('option:selected');
        var trainer = $('#coursePlanTrainer').children('option:selected');
        var from = $('#coursePlanDateFrom').val();
        var to = $('#coursePlanDateTo').val();
        var mincount = $('#coursePlanTeilnehmerMin').val();
        var maxcount = $('#coursePlanTeilnehmerMax').val();
        var times = new Array();
        times[0] = new Array( $('#coursePlanSonntagVon').val(), $('#coursePlanSonntagBis').val());
        times[1] = new Array( $('#coursePlanMontagVon').val(), $('#coursePlanMontagBis').val());
        times[2] = new Array( $('#coursePlanDinestagVon').val(), $('#coursePlanDienstagBis').val());
        times[3] = new Array( $('#coursePlanMittwochVon').val(), $('#coursePlanMittwochBis').val());
        times[4] = new Array( $('#coursePlanDonnerstagVon').val(), $('#coursePlanDonnerstagBis').val());
        times[5] = new Array( $('#coursePlanFreitagVon').val(), $('#coursePlanFreitagBis').val());
        times[6] = new Array( $('#coursePlanSamstagVon').val(), $('#coursePlanSamstagBis').val());


        for(var i = 0; i < times.length; i++) {
            if(times[i][0] == '' || times[i][1] == '') {
                delete(times[i]);
            }
        }

        if(from != '' && to != '' && mincount != '' && maxcount != '') {
            var dateFrom = parseDate(from);
            var dateTo = parseDate(to);

            for (var d = dateFrom; d <= dateTo; d.setDate(d.getDate() + 1)) {
                var courseId = <?php echo $course['Course']['id']; ?>;
                var dayTime = times[d.getDay()];
                if(typeof dayTime != 'undefined') {
                    var begDateTime = from+' '+dayTime[0];
                    var endDateTime = from+' '+dayTime[1];

                    var beg = '<td class="begin"><div><span class="popoverElement">'+begDateTime+'</span></div></td>';
                    var end = '<td class="end"><div><span class="popoverElement">'+endDateTime+'</span></div></td>';
                    var director = '<td class="director"><div><span class="popoverElement">'+trainer.text()+'</span></div></td>';
                    var raum = '<td class="room_id"><div><span class="popoverElement">'+room.text()+'</span></div></td>';
                    var min = '<td class="mincount"><div><span class="popoverElement">'+mincount+'</span></div></td>';
                    var max = '<td class="maxcount"><div><span class="popoverElement">'+maxcount+'</span></div></td>';
                    var check = '<td><button class="btn btn-default" onclick="courseAddVorlageEntry('+courseId+',\''+begDateTime+'\',\''+endDateTime+'\','+trainer.val()+','+room.val()+','+mincount+','+maxcount+', '+planId+')">Buchen</button></td>';

                    $('#coursePlanTable > tbody').append('<tr id="coursePlanTableEntry'+planId+'">'+beg+end+director+raum+min+max+check+'</tr>');
                    planId++;
                }
            }
        }
    }
    function parseDate(input) {
    var parts = input.match(/(\d+)/g);
    return new Date(parts[2], parts[1]-1, parts[0]);
    }

    function courseAddVorlageEntry(courseId, begin, end, director, room_id, mincount, maxcount, tableEntryId) {
        $.post('<?php echo $this->webroot; ?>dates/add/'+courseId, {
            "data[Date][course_id]":courseId,
            "data[Date][begin]":begin,
            "data[Date][end]": end,
            "data[Date][director]": director,
            "data[Date][room_id]": room_id,
            "data[Date][mincount]": mincount,
            "data[Date][maxcount]": maxcount
        }, function(json){
            if(json.success) {
                notificateUser(json.message, 'success');
                $( "#courseEntries" ).trigger({
                    type:"courseChanged",
                    courseId:courseId
                });
                $('#coursePlanTableEntry'+tableEntryId).remove();
                $.get('<?php echo $this->webroot; ?>courses/plan/'+courseId, function(view) {
                    $('#courseExistTable').replaceWith($(view).find('#courseExistTable'));
                });
            }else {
                notificateUser(json.message);
                for(var controller in json.errors) {
                    for(var key in json.errors[controller]) {
                        if(json.errors[controller].hasOwnProperty(key)) {
                            notificateUser(json.errors[controller][key]);
                            var ele = $('#coursePlanTableEntry'+tableEntryId);
                            ele.children('.'+key).addClass('warning')
                            ele.children('.'+key).children('div').children('.popoverElement').popover({
                                html: true,
                                trigger: 'hover',
                                placement: 'top',
                                content: json.errors[controller][key]
                            });
                        }
                    }
                }
            }
        });
    }

    $("#courseEntries").on('courseChanged', function(event) {
        if(event.courseId == <?php echo $course['Course']['id']?>) {
            $.get('<?php echo $this->webroot; ?>courses/plan/'+event.courseId, function(view) {
                $('#courseExistTable').replaceWith($(view).find('#courseExistTable'));
            });
        }
    });


    <?php echo $this->Html->scriptEnd();?>
    <style>
        .datepicker{z-index:1151 !important;}
        span.glyphicon-remove-circle {
            position: absolute;
            right: 5px;
            top: 0;
            bottom: 0;
            height: 14px;
            margin: auto;
            font-size: 14px;
            cursor: pointer;
            color: #ccc;
        }
    </style>
</div>