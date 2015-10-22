<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\components\MultiLingualController;
use common\models\Content;
use common\models\ContentSearch;

/**
 * ContentController implements the CRUD actions for Content model.
 */
class ContentController extends MultiLingualController
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
		$contentSearch  = new ContentSearch;
		$contentProvider = $contentSearch->search($_GET);

		return $this->render('index', compact('contentSearch', 'contentProvider'));
	}

	public function actionCreate()
	{
		$content = new Content;

        if ($content->load($_POST) && $content->save()) {
            Yii::$app->session->setFlash('success', Yii::t('backend', 'New Page created successfully'));
            return $this->redirect(['index']);
        }

        return $this->render('create', compact('content'));
	}

	public function actionUpdate($id)
	{
		$content = $this->findContent($id);
        if ($content->load($_POST) && $content->save()) {
            Yii::$app->session->setFlash('success', Yii::t('backend', 'Page updated successfully'));
            return $this->redirect(['index']);
        }

        return $this->render('create', compact('content'));

	}

	protected function findContent($id)
	{
        $content = Content::findOne($id);
        if (!isset($content)) {
            throw new HttpException(404, Yii::t('backend/view','The requested page does not exist.'));
        }

        return $content;

	}
}
