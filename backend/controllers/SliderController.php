<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use common\components\MultiLingualController;
use common\models\Slider;
use common\models\SliderSearch;

class SliderController extends MultiLingualController{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'update' => ['post'],
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
        //var_dump($_POST);die;
        $slider = new Slider;
        if ($slider->load($_POST) && $slider->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('create', compact('slider'));
    }
}
?>