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

<div class="stackoverflow-search-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'number',
            [
                'label' => 'Body',
                'format' => 'raw',
                'attribute' => 'content',
                'filter' => true,
                'value' => function ($model) {
                    
                    return \Yii::$app->formatter->asNtext($model->content);
                },
                'contentOptions' => ['style'=>'overflow: scroll; max-width: 800px;']
            ],
            [
                'label' => 'Answers',
                'format' => 'raw',
                'value' => function ($model) {
                    $html = Html::a(
                        "Answers: ".
                        $model->getStackoverflowAnswers()->count(),
                        [
                            'answers',
                            'question_id' => $model->id,
                            'search_id' => $model->search_id,
                        ],
                        ['class' => 'btn btn-success']
                    );
                    return $html;
                },
            ]
        ],
    ]); ?>
</div>
