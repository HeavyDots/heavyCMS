<?php

namespace backend\controllers;

use Yii;
use yii\base\Model;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\UploadedFile;
use yii\web\Response;
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
                        'actions' => ['index', 'create', 'update', 'upload-image'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'upload-image' => ['post'],
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

    /*TODO: Generalize duplicated code on actionCreate and actionUpdate */
	public function actionCreate()
	{
        $blogPost = new BlogPost();
        $translations = $blogPost->initializeTranslations();
        Model::loadMultiple($translations, $_POST);
        if ($blogPost->load($_POST) &&
            Model::loadMultiple($translations, $_POST) &&
            Model::validateMultiple($translations) &&
            $blogPost->save())
        {
            $blogPost->saveTranslations($translations);
            $blogPost->uploadedFeaturedImage = UploadedFile::getInstance($blogPost, 'uploadedFeaturedImage');
            if($blogPost->saveFeaturedImageToDisk()){
                Yii::$app->session->setFlash('success', Yii::t('app', 'Blog Post created successfully'));
            }
            else{
                Yii::$app->session->setFlash('error', Yii::t('app', 'There was some error uploading the blog post Image'));
            }
            return $this->redirect(['index']);
        }

        return $this->render('create', compact('blogPost', 'translations'));
	}

	public function actionUpdate($id)
	{
		$blogPost = $this->findBlogPost($id);
        $translations = $blogPost->initializeTranslations();
        Model::loadMultiple($translations, $_POST);
        if ($blogPost->load($_POST) &&
            Model::loadMultiple($translations, $_POST) &&
            Model::validateMultiple($translations) &&
            $blogPost->save())
        {
            $blogPost->saveTranslations($translations);
            $blogPost->uploadedFeaturedImage = UploadedFile::getInstance($blogPost, 'uploadedFeaturedImage');
            if($blogPost->saveFeaturedImageToDisk()){
                Yii::$app->session->setFlash('success', Yii::t('app', 'Blog Post updated successfully'));
            }
            else{
                Yii::$app->session->setFlash('error', Yii::t('app', 'There was some error uploading the blog post Image'));
            }
            return $this->redirect(['index']);
        }

        return $this->render('update', compact('blogPost', 'translations'));
	}

    public function actionUploadImage($blogPostId){
        if (Yii::$app->request->isAjax) {
            $blogPost = $this->findBlogPost($blogPostId);
            $image = UploadedFile::getInstanceByName('fileUploaded');
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ['url' => $blogPost->saveImageToDisk($image)];
        }
    }

	protected function findBlogPost($id)
	{
        $blogPost = BlogPost::findOne($id);
        if (!isset($blogPost)) {
            throw new HttpException(404, Yii::t('app','The requested page does not exist.'));
        }

        return $blogPost;

	}
}
