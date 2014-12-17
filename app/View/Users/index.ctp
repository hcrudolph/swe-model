<?php
foreach($users as $user)
{
    echo $this->element('user', array('user' => $user));
}

?>