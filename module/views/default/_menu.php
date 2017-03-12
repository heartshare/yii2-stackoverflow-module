<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

?>

<div class="wrap">
    <?php
    
    NavBar::begin([
        'options' => [
            'class' => 'navbar navbar-inverse',
        ],
    ]);
    
    echo Nav::widget([
        'options' => ['class' => 'nav navbar-nav'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</div>