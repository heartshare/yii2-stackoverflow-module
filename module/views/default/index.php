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

            'search',
            [
                'label' => 'Results',
                'format' => 'raw',
                'value' => function ($model) {
                    $html = Html::a(
                        "Questions",
                        ['questions', 'search_id' => $model->id],
                        ['class' => 'btn btn-success']
                    );
                    return $html;
                },
            ]
        ],
    ]); ?>
</div>
