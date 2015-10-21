<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use yii\web\HttpException;

use common\components\MultiLingualController;
use backend\models\Gallery;
use common\models\GallerySearch;

class GalleryController extends MultiLingualController{

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

    public function actionIndex(){
        $gallerySearch = new GallerySearch;
        $galleryProvider = $gallerySearch->search($_GET);

        return $this->render('index', compact('gallerySearch', 'galleryProvider'));
    }

    public function actionCreate(){
        $gallery = new Gallery;
        if ($gallery->load($_POST) && $gallery->save()) {
            $gallery->uploadedImages = UploadedFile::getInstances($gallery, 'uploadedImages');
            $gallery->saveImagesOnDisk();
            Yii::$app->session->setFlash('success', Yii::t('backend', 'Gallery created successfully'));
            return $this->redirect(['index']);
        }
        return $this->render('create', compact('gallery'));
    }

    public function actionUpdate($id){
        $gallery = $this->findGallery($id);
        if ($gallery->load($_POST) && $gallery->save()) {
            $galleryImagesOrderArray = explode(',', $_POST['galleryImagesOrder']);
            $gallery->reorderGalleryImages($galleryImagesOrderArray);
            $gallery->uploadedImages = UploadedFile::getInstances($gallery, 'uploadedImages');
            $gallery->saveImagesOnDisk();
            Yii::$app->session->setFlash('success', Yii::t('backend', 'Gallery updated successfully'));

            return $this->redirect(['index']);
        }
        return $this->render('update', compact('gallery'));
    }

    protected function findGallery($id){
        $gallery = Gallery::findOne($id);
        if (!isset($gallery)) {
            throw new HttpException(404, Yii::t('backend/view','The requested page does not exist.'));
        }

        return $gallery;

    }
}
?>