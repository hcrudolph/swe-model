<?php

if(sizeof($posts) > 0) {
    $listObjects = '';
    $carouselObjects = '';
    for ($i = 0; $i < sizeof($posts); $i++) {
        $post = $posts[$i]['Post'];
        $listObjects .= '<li data-target="#postsBarCarousel" data-slide-to="' . $i . '" class="' . (($i == 0) ? 'active' : '') . '"></li>';
        $carouselObjects .= '<div class="item' . (($i == 0) ? ' active' : '') . '">
                <div class="carousel-image-placeholder"></div>
                <div class="carousel-caption">
                    <h3>' . $post['heading'] . '</h3>
                    <p>' . ((strlen($post['body']) < 50) ? $post['body'] : substr($post['body'], 0, 46) . '...') . '</p>
                </div>
            </div>';
    }
} else{
    $listObjects = '<li data-target="#postsBarCarousel" data-slide-to="0" class="active"></li>';
    $carouselObjects = '<div class="item active">
                <div class="carousel-image-placeholder"></div>
                <div class="carousel-caption">
                    <h3>Keine Einträge</h3>
                    <p>Derzeit sind keine vorhanden.</p>
                </div>
            </div>';
}
?>

<div id="postsBarCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php
        echo $listObjects
        ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <?php
        echo $carouselObjects;
        ?>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#postsBarCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Zurück</span>
    </a>
    <a class="right carousel-control" href="#postsBarCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Weiter</span>
    </a>
</div>