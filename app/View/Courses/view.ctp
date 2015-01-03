<?php
$courseId = $course['Course']['id'];
?>
<div id="courseEntry<?php echo $courseId; ?>" class="row">
    <div class="col-xs-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Kursname</h3>
            </div>
            <div class="panel-body">
                <?php echo h($course['Course']['name']); ?>
            </div>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Schwierigkeitsgrad</h3>
            </div>
            <div class="panel-body">
                <?php echo h($course['Course']['level']); ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Kursbeschreibung</h3>
            </div>
            <div class="panel-body">
                <?php echo nl2br(h($course['Course']['description'])); ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left">
                    Termine
                </h4>
                <?php if(isset($user) AND $user['role'] > 0) {?>
                    <div class="btn-group pull-right">
                        <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="dateAdd('<?php echo $this->webroot; ?>Dates/add/', <?php echo $courseId; ?>);">Hinzufügen</a>
                    </div>
                <?php } ?>
            </div>
            <table class="table">
                <tr>
                    <th>Beginn</th>
                    <th>Ende</th>
                    <th>Trainer</th>
                    <th>Raum</th>
                    <th>Minimale Teilnehmer</th>
                    <th>Maximale Teilnehmer</th>
                    <th>Derzeitige Teilnehmer</th>
                    <th>Aktionen</th>
                </tr>
                <?php foreach($course['Date'] as $date) { $dateId = $date['id'];?>
                    <tr>
                        <td><?php echo $date['begin']; ?></td>
                        <td><?php echo $date['end']; ?></td>
                        <td><?php echo $date['Trainer']['Person']['surname'].' '.$date['Trainer']['Person']['name']; ?></td>
                        <td><?php echo $date['Room']['name']; ?></td>
                        <td><?php echo $date['mincount']; ?></td>
                        <td><?php echo $date['maxcount']; ?></td>
                        <td><?php echo count($date['Account']);?></td>
                        <td><?php
                            //Check if User is already registered
                            $userSignedUp = false;
                            foreach($date['Account'] as $account)
                            {
                                if($user['id']==$account['id']){$userSignedUp=true;}
                            }
                            $elements = array();
                            if($userSignedUp) {
                                $elements[0] = '<button type="button" class="btn btn-default" onclick="dateSignOffUser(' . $date['id'] . ', \''.$this->webroot.'dates/signoffUser/\')">Abmelden</button>';
                                $elements[1] = '<li><a href="javascript:void(0)" onclick="dateSignOffUser(' . $date['id'] . ', \''.$this->webroot.'dates/signoffUser/\')"> Abmelden</a></li>';
                            } elseif(count($date['Account']) < $date['maxcount']) {
                                $elements[0] = '<button type="button" class="btn btn-default" onclick="dateSignUpUser(' . $date['id'] . ', \''.$this->webroot.'dates/signupUser/\')">Anmelden</button>';
                                $elements[1] = '<li><a href="javascript:void(0)" onclick="dateSignUpUser(' . $date['id'] . ', \''.$this->webroot.'dates/signupUser/\')"> Anmelden</a></li>';
                            } else {
                                $elements[0] = '<span class="btn btn-default">Ausgebucht</span>';
                                $elements[1] = '<li><a>Ausgebucht</a></li>';
                            }
                            if($user['role'] > 0) {
                                $elements[0] = '<button type="button" class="btn btn-default" onclick="dateEdit(\''.$this->webroot.'/Dates/edit/\', '.$date['id'].')"><i class="glyphicon glyphicon-pencil"></i></button>';
                                $elements[] = '<li class="divider"></li>';
                                $elements[] = '<li><a href="javascript:void(0)" onclick="dateEdit(\''.$this->webroot.'/Dates/edit/\', '.$date['id'].')"> Bearbeiten</a></li>';
                                $elements[] = '<li><a href="javascript:void(0)" onclick="dateDelete(\''.$this->webroot.'dates/delete/\', '.$date['id'].', '.$courseId.')"> Absagen</a></li>';
                            }
                            ?>

                            <div class="btn-group">
                                <?php echo $elements[0];?>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <?php
                                    for($i=1;$i<count($elements);$i++) {
                                        echo $elements[$i];
                                    }
                                    ?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>