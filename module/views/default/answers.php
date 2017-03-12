<?php

use yii\helpers\Html;
use yii\grid\GridView;

$menuItems = [
        ['label' => 'Searches', 'url' => ['index']],
        ['label' => 'Search form', 'url' => ['search']],
    ];
   
?>
<?= $this->render('_menu', [
    'menuItems' => $menuItems
]) ?>


<?= Html::a("Return to questions", ['questions', 'search_id' => $searchModel->search_id], ['class' => 'btn btn-info']) ?>


<div class="stackoverflow-search-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Body',
                'format' => 'raw',
                'attribute' => 'content',
                'filter' => true,
                'value' => function ($model) {
                    
                    return "<span>".$model->content."</span>";
                },
                'contentOptions' => ['style'=>'overflow: scroll; max-width: 800px;']
            ],
            [
                'label' => 'Score',
                'format' => 'raw',
                'attribute' => 'score',
                'filter' => true,
                'value' => function ($model) {
                    return "<span class='btn btn-warning glyphicon glyphicon-plus-sign' > ".$model->score."</span>";
                },
            ],
            
            
        ],
    ]); ?>
</div>
