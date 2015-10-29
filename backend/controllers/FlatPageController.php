<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\components\MultiLingualController;
use common\models\FlatPage;
use common\models\FlatPageSearch;

/**
 * FlatPageController implements the CRUD actions for FlatPage model.
 */
class FlatPageController extends MultiLingualController
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
		$flatPageSearch  = new FlatPageSearch;
		$flatPageProvider = $flatPageSearch->search($_GET);

		return $this->render('index', compact('flatPageSearch', 'flatPageProvider'));
	}

	public function actionCreate()
	{
		$flatPage = new FlatPage;

        if ($flatPage->load($_POST) && $flatPage->save()) {
            $flatPage->saveTranslationsPOST($_POST['Translations']);
            Yii::$app->session->setFlash('success', Yii::t('backend', "New Page {$flatPage} created successfully"));
            return $this->redirect(['index']);
        }

        return $this->render('create', compact('flatPage'));
	}

	public function actionUpdate($id)
	{
		$flatPage = $this->findFlatPage($id);
        if ($flatPage->load($_POST) && $flatPage->save()) {
            $flatPage->saveTranslationsPOST($_POST['Translations']);
            Yii::$app->session->setFlash('success', Yii::t('backend', "Page {$flatPage} updated successfully"));
            return $this->redirect(['index']);
        }

        return $this->render('update', compact('flatPage'));

	}

	protected function findFlatPage($id)
	{
        $flatPage = FlatPage::findOne($id);
        if (!isset($flatPage)) {
            throw new HttpException(404, Yii::t('backend/view','The requested page does not exist.'));
        }

        return $flatPage;

	}
}
