<?php

namespace backend\controllers;

use Yii;
use yii\base\Model;
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

    /*TODO: Generalize duplicated code on actionCreate and actionUpdate */
	public function actionCreate()
	{
		$flatPage = new FlatPage;
        $translations = $flatPage->initializeTranslations();

        if ($flatPage->load(Yii::$app->request->post()) &&
            Model::loadMultiple($translations, Yii::$app->request->post()) &&
            Model::validateMultiple($translations) &&
            $flatPage->save())
        {
            $flatPage->saveTranslations($translations);
            Yii::$app->session->setFlash('success', Yii::t('app', "Page {$flatPage} created successfully"));
            return $this->redirect(['index']);
        }

        return $this->render('create', compact('flatPage', 'translations'));

	}

	public function actionUpdate($id)
	{
		$flatPage = $this->findFlatPage($id);
        $translations = $flatPage->initializeTranslations();

        if ($flatPage->load(Yii::$app->request->post()) &&
            Model::loadMultiple($translations, Yii::$app->request->post()) &&
            Model::validateMultiple($translations) &&
            $flatPage->save())
        {
            $flatPage->saveTranslations($translations);
            Yii::$app->session->setFlash('success', Yii::t('app', "Page {$flatPage} updated successfully"));
            return $this->redirect(['index']);
        }

        return $this->render('update', compact('flatPage', 'translations'));

	}

	protected function findFlatPage($id)
	{
        $flatPage = FlatPage::findOne($id);
        if (!isset($flatPage)) {
            throw new HttpException(404, Yii::t('app','The requested page does not exist.'));
        }

        return $flatPage;

	}
}
