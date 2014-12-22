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

<div id="sidebar">
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="active"><a href="#content" data-url="<?php echo $this->webroot;?>posts">News</a></li>
        <li role="presentation"><a href="#content" data-url="<?php echo $this->webroot;?>calendar/init">Kalender</a></li>
        <li role="presentation"><a href="#content" data-url="<?php echo $this->webroot;?>lists">Listen</a></li>
        <?php
        if(!empty($user)){
        ?>
        <li role="presentation"><a href="#content" data-url="<?php echo $this->webroot;?>studio">Studiomanagement</a></li>
        <li role="presentation"><a href="#content" data-url="<?php echo $this->webroot;?>users">Usermanagement</a></li>
        <li role="presentation"><a href="#content" data-url="<?php echo $this->webroot;?>posts">Kursmanagement</a></li>
        <?php } ?>
    </ul>
</div>


<?php echo $this->Html->scriptStart(array('inline' => true)); ?>
$('#sidebar > .nav-pills a').click(function (e) {
    e.preventDefault();

    var url = $(this).attr("data-url");
    var href = this.hash;
    var pane = $(this);

    // ajax load from data-url
    $(href).load(url,function(result){
        pane.tab('show');
    });
});

// Content für angezeigten Tab
$('#content').load('<?php echo $this->webroot;?>posts/',function(result){
    $('#sidebar > .active a').tab('show');
});
<?php echo $this->Html->scriptEnd(); ?>