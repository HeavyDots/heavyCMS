<?php
namespace frontend\controllers;

use Yii;

use yii\data\ActiveDataProvider;
use yii\web\HttpException;
use common\components\MultiLingualController;

use common\models\FlatPage;

class FlatPageController extends MultiLingualController{

    public function actionSelect($slug, $url){
        /* Create code to render the view for each $url
         * You need to create a view file, under your view folder,
         * and name the file the same as the $flatPage->url.
         * i.e.: $url = about-us . You need to create views/flat-page/about-us.php
         */
        /*
         switch ($url) {
            case 'contact':
                return Yii::$app->runAction('flat-page/contact');
                break;
            case 'accommodation':
                return Yii::$app->runAction('flat-page/accommodation');
                break;
            default:
                return Yii::$app->runAction('flat-page/common-flat-page', ['url' => $url]);
                break;
            }

            public function actionCommonFlatPage($url){
                $flatPage = FlatPage::findOne(['url'=>$url]);
                return $this->render($url, compact('flatPage'));
            }
         * */

        echo "{$slug}";
        return $this->render('//site/index');
    }

}