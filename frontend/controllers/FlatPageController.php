<?php
namespace frontend\controllers;

use Yii;

use yii\data\ActiveDataProvider;
use yii\web\HttpException;
use common\components\MultiLingualController;

use common\models\FlatPage;

class FlatPageController extends MultiLingualController{

    public function actionSelect($slug, $url){
      
        $customActions=array();
        if (isset(Yii::$app->params['flatPage']) && isset(Yii::$app->params['flatPage']['customActions'])) {
          $customActions=Yii::$app->params['flatPage']['customActions'];
        }
        
        if (isset($customActions[$url])) {
          return Yii::$app->runAction($customActions[$url], $_GET);
        } else {
          return Yii::$app->runAction('flat-page/common-flat-page', $_GET);
        }
      
    }

    public function actionCommonFlatPage($url){
        $flatPage = FlatPage::findOne(['url'=>$url]);
        $this->flatPage=$flatPage;
        return $this->render($url, compact('flatPage'));
    }

}