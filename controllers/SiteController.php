<?php

namespace app\controllers;

use app\components\export\AbstractFactory;
use app\models\search\HistorySearch;
use Yii;
use yii\db\Query;
use yii\web\Controller;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    /**
     * @param string $exportType
     * @return string
     */
    public function actionExport($exportType)
    {
        $model = new HistorySearch();
        /** @var Query $query */
        $query = $model->getQuery(Yii::$app->request->queryParams);
        $exportFileLink = AbstractFactory::create($exportType)->export($query);

        return $this->redirect($exportFileLink);
    }
}
