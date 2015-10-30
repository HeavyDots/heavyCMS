<?php

namespace backend\controllers;

use Yii;
use yii\base\Model;
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
        //Avoid saving an unwanted translation. It must be a bug on translatable behavior
        $blogPost->detachBehavior('translatable');
        $blogPost->save();
        Yii::$app->session->setFlash('success', Yii::t('backend', "New BlogPost created successfully"));
        return $this->redirect(['update', 'id'=>$blogPost->id]);

	}

	public function actionUpdate($id)
	{
		$blogPost = $this->findBlogPost($id);
        $translations = $blogPost->initializeTranslations();
        Model::loadMultiple($translations, $_POST);
        //Avoid saving an unwanted translation. It must be a bug on translatable behavior
        $blogPost->detachBehavior('translatable');
        if ($blogPost->load($_POST) &&
            Model::loadMultiple($translations, $_POST) &&
            Model::validateMultiple($translations) &&
            $blogPost->save())
        {
            $blogPost->saveTranslations($translations);
            Yii::$app->session->setFlash('success', Yii::t('backend', "BlogPost updated successfully"));
            return $this->redirect(['index']);
        }

        return $this->render('update', compact('blogPost', 'translations'));

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
