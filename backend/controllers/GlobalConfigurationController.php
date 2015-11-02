<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\components\MultiLingualController;
use common\models\GlobalConfiguration;
use common\models\GlobalConfigurationSearch;

/**
 * GlobalConfigurationController implements the CRUD actions for GlobalConfiguration model.
 */
class GlobalConfigurationController extends MultiLingualController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'update' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

	public function actionIndex()
	{
		$globalConfigurationSearch  = new GlobalConfigurationSearch;
		$globalConfigurationProvider = $globalConfigurationSearch->search($_GET);

		return $this->render('index', compact('globalConfigurationSearch', 'globalConfigurationProvider'));
	}

	public function actionCreate()
	{
		$globalConfiguration = new GlobalConfiguration;

        if ($globalConfiguration->load($_POST) && $globalConfiguration->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'New Configuration created successfully'));
            return $this->redirect(['index']);
        }

        return $this->render('create', compact('globalConfiguration'));
	}

	public function actionUpdate($id)
	{
		$globalConfiguration = $this->findGlobalConfiguration($id);
        if ($globalConfiguration->load($_POST) && $globalConfiguration->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Configuration updated successfully'));
            return $this->redirect(['index']);
        }

        return $this->render('update', compact('globalConfiguration'));

	}

	protected function findGlobalConfiguration($id)
	{
        $globalConfiguration = GlobalConfiguration::findOne($id);
        if (!isset($globalConfiguration)) {
            throw new HttpException(404, Yii::t('app','The requested page does not exist.'));
        }

        return $globalConfiguration;

	}
}
