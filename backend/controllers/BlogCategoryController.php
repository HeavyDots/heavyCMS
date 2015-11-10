<?php

namespace backend\controllers;

use Yii;
use yii\base\Model;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\components\MultiLingualController;
use common\models\BlogCategory;
use common\models\BlogCategorySearch;

/**
 * BlogCategoryController implements the CRUD actions for BlogCategory model.
 */
class BlogCategoryController extends MultiLingualController
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
        $blogCategorySearch  = new BlogCategorySearch;
        $blogCategoryProvider = $blogCategorySearch->search($_GET);

        return $this->render('index', compact('blogCategorySearch', 'blogCategoryProvider'));
    }

    /*TODO: Generalize duplicated code on actionCreate and actionUpdate */
    public function actionCreate()
    {
        $blogCategory = new BlogCategory;
        $translations = $blogCategory->initializeTranslations();

        if (Model::loadMultiple($translations, $_POST) &&
            Model::validateMultiple($translations) &&
            $blogCategory->save())
        {
            $blogCategory->saveTranslations($translations);
            Yii::$app->session->setFlash('success', Yii::t('app', "Blog Category {$blogCategory->name} created successfully"));
            return $this->redirect(['index']);
        }

        return $this->render('create', compact('blogCategory', 'translations'));

    }

    public function actionUpdate($id)
    {
        $blogCategory = $this->findBlogCategory($id);
        $translations = $blogCategory->initializeTranslations();

        if (Model::loadMultiple($translations, $_POST) &&
            Model::validateMultiple($translations) &&
            $blogCategory->save())
        {
            $blogCategory->saveTranslations($translations);
            Yii::$app->session->setFlash('success', Yii::t('app', "Blog Category {$blogCategory->name} updated successfully"));
            return $this->redirect(['index']);
        }

        return $this->render('update', compact('blogCategory', 'translations'));

    }

    protected function findBlogCategory($id)
    {
        $blogCategory = BlogCategory::findOne($id);
        if (!isset($blogCategory)) {
            throw new HttpException(404, Yii::t('app','The requested page does not exist.'));
        }

        return $blogCategory;

    }
}
