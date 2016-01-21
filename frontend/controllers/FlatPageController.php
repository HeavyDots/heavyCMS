<?php
namespace frontend\controllers;

use Yii;

use yii\data\ActiveDataProvider;
use yii\web\HttpException;
use common\components\MultiLingualController;

use common\models\FlatPage;

class FlatPageController extends MultiLingualController{

    public function actionIndex($slug, $url){
        /* Create code to render the view for each $url */
        echo "{$slug}";
    }

}