<?php
$courseID = $course['Course']['id'];
?>
<div id="courseEntry<?php echo $courseID; ?>" class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Kursname</h3>
            </div>
            <div class="panel-body">
                <?php echo h($course['Course']['name']); ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Kursbeschreibung</h3>
            </div>
            <div class="panel-body">
                <?php echo h($course['Course']['description']); ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">Kurszeiten</div>
            <table class="table">
                <tr>
                    <th>Beginn</th>
                    <th>Ende</th>
                    <th>Trainer</th>
                    <th>Raum</th>
                    <th>Aktionen</th>
                </tr>
                <?php foreach($course['Date'] as $date) { $dateId = $date['id'];?>
                    <tr>
                        <td><?php echo $date['begin']; ?></td>
                        <td><?php echo $date['end']; ?></td>
                        <td><?php echo $date['Trainer']['Person']['surname'].' '.$date['Trainer']['Person']['name']; ?></td>
                        <td><?php echo $date['Room']['name']; ?></td>
                        <td><?php
                            //Check if User is already registered
                            $userSignedUp = false;
                            foreach($date['Account'] as $account)
                            {
                                if($user['id']==$account['id']){$userSignedUp=true;}
                            }
                            $elements = array();
                            if($userSignedUp) {
                                $elements[0] = '<button type="button" class="btn btn-default" onclick="courseDateSignOffUser(' . $date['id'] . ')">Abmelden</button>';
                                $elements[1] = '<li><a href="javascript:void(0)" onclick="courseDateSignOffUser('.$date['id'].')"> Abmelden</a></li>';
                            } elseif(count($date['Account']) < $course['Course']['maxcount']) {
                                $elements[0] = '<button type="button" class="btn btn-default" onclick="courseDateSignUpUser('.$date['id'].')">Anmelden</button>';
                                $elements[1] = '<li><a href="javascript:void(0)" onclick="courseDateSignUpUser(' . $date['id'] . ')"> Anmelden</a></li>';
                            } else {
                                $elements[0] = '<span class="btn btn-default">Ausgebucht</span>';
                                $elements[1] = '<li><a>Ausgebucht</a></li>';
                            }
                            if($user['role'] > 0) {
                                $elements[0] = '<button type="button" class="btn btn-default" onclick="courseDateEdit('.$date['id'].')">Bearbeiten</button>';
                                $elements[] = '<li class="divider"></li>';
                                $elements[] = '<li><a href="javascript:void(0)" onclick="courseDateEdit('.$date['id'].')"> Bearbeiten</a></li>';
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
    <div class="col-xs-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Minimale Teilnehmeranzahl</h3>
            </div>
            <div class="panel-body">
                <?php echo h($course['Course']['mincount']); ?>
            </div>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Maximale Teilnehmeranzahl</h3>
            </div>
            <div class="panel-body">
                <?php echo h($course['Course']['maxcount']); ?>
            </div>
        </div>
    </div>
</div>