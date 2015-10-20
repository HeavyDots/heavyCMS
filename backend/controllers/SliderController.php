<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;

use common\components\MultiLingualController;
use backend\models\Slider;
use common\models\SliderSearch;

class SliderController extends MultiLingualController{

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
        $sliderSearch = new SliderSearch;
        $sliderProvider = $sliderSearch->search($_GET);

        return $this->render('index', compact('sliderSearch', 'sliderProvider'));
    }

    public function actionCreate(){
        $slider = new Slider;
        if ($slider->load($_POST) && $slider->save()) {
            $slider->uploadedImages = UploadedFile::getInstances($slider, 'uploadedImages');
            $slider->saveImagesOnDisk();
            Yii::$app->session->setFlash('success', Yii::t('backend', 'Slider created successfully'));
            return $this->redirect(['index']);
        }
        return $this->render('create', compact('slider'));
    }

    public function actionUpdate($id){
        $slider = Slider::findOne($id);
        if ($slider->load($_POST) && $slider->save()) {
            $slidesImagesOrderArray = explode(',', $_POST['sliderImagesOrder']);
            $slider->reorderSliderImages($slidesImagesOrderArray);
            Yii::$app->session->setFlash('success', Yii::t('backend', 'Slider updated successfully'));
            return $this->redirect(['index']);
        }
        return $this->render('update', compact('slider'));
    }
}
?>