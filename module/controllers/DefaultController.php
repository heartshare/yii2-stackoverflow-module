<?php

namespace shamanzpua\module\controllers;

use Yii;
use yii\web\Controller;
use shamanzpua\module\models\search\FindStackoverflowSearch;
use shamanzpua\module\models\search\StackoverflowAnswerSearch;
use shamanzpua\module\models\search\StackoverflowQuestionSearch;
use shamanzpua\module\models\StackoverflowSearch;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new FindStackoverflowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionQuestions()
    {
        $searchModel = new StackoverflowQuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('questions', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionAnswers()
    {
        $searchModel = new StackoverflowAnswerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('answers', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionSearch()
    {
        $model = Yii::createObject(StackoverflowSearch::class);
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->grab();
            if (!$model->hasErrors()) {
                $this->redirect(['index']);
            }
        }

        return $this->render('search', [
            'model' => $model
        ]);
    }
}
