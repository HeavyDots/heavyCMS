<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\components\MultiLingualController;
use common\models\BlogPost;
use common\models\BlogPostSearch;

/**
 * BlogPostController implements the CRUD actions for BlogPost model.
 */
class BlogPostController extends MultiLingualController
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
		$blogPostSearch  = new BlogPostSearch;
		$blogPostProvider = $blogPostSearch->search($_GET);

		return $this->render('index', compact('blogPostSearch', 'blogPostProvider'));
	}

	public function actionCreate()
	{
		$blogPost = new BlogPost;
        if ($blogPost->load($_POST) && $blogPost->save()) {
            $blogPost->saveTranslationsPOST($_POST['Translations']);
            Yii::$app->session->setFlash('success', Yii::t('backend', "New BlogPost {$blogPost->title} created successfully"));
            return $this->redirect(['index']);
        }

        return $this->render('create', compact('blogPost'));
	}

	public function actionUpdate($id)
	{
		$blogPost = $this->findBlogPost($id);
        if ($blogPost->load($_POST) && $blogPost->save()) {
            $blogPost->saveTranslationsPOST($_POST['Translations']);
            Yii::$app->session->setFlash('success', Yii::t('backend', "BlogPost {$blogPost->title} updated successfully"));
            return $this->redirect(['index']);
        }

        return $this->render('update', compact('blogPost'));

	}

	protected function findBlogPost($id)
	{
        $blogPost = BlogPost::findOne($id);
        if (!isset($blogPost)) {
            throw new HttpException(404, Yii::t('backend/view','The requested page does not exist.'));
        }

        return $blogPost;

	}
}
