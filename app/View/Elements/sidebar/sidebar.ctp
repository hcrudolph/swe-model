<?php
$controllerIndex = array(
    'posts' => 0,
    'calendar' => 1,
    'lists' => 2,
    'studio' => 3,
    'user' => 4,
    'Kurs' => 5
);
$sidebarIndex = ((array_key_exists($this->params['controller'], $controllerIndex))?$controllerIndex[$this->params['controller']]:0);
?>

<core-menu selected="<?php echo $sidebarIndex*2 ?>" selectedindex="<?php echo $sidebarIndex*2 ?>" id="sidebar">
    <?php
    echo $this->element('sidebar/submenuNews');
    echo $this->element('sidebar/submenuKalender');
    echo $this->element('sidebar/submenuListen');
    if (!empty($user))
    {
        echo $this->element('sidebar/submenuStudio');
        echo $this->element('sidebar/submenuUser');
        echo $this->element('sidebar/submenuKurs');
    }
    ?>
</core-menu>