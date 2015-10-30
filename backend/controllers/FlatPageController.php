<?php

namespace backend\controllers;

use Yii;
use yii\base\Model;
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
        //Avoid saving an unwanted translation. It must be a bug on translatable behavior
        $flatPage->detachBehavior('translatable');
        if ($flatPage->load($_POST) && $flatPage->save()){
            Yii::$app->session->setFlash('success', Yii::t('backend', "New Page {$flatPage} created successfully"));
            return $this->redirect(['update', 'id' => $flatPage->id]);
        }

        return $this->render('create', compact('flatPage'));
	}

	public function actionUpdate($id)
	{
		$flatPage = $this->findFlatPage($id);
        $translations = $flatPage->initializeTranslations();

        //Avoid saving an unwanted translation. It must be a bug on translatable behavior
        $flatPage->detachBehavior('translatable');
        if ($flatPage->load($_POST) &&
            Model::loadMultiple($translations, $_POST) &&
            Model::validateMultiple($translations) &&
            $flatPage->save())
        {
            $flatPage->saveTranslations($translations);
            Yii::$app->session->setFlash('success', Yii::t('backend', "Page {$flatPage} updated successfully"));
            return $this->redirect(['index']);
        }

        return $this->render('update', compact('flatPage', 'translations'));

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
