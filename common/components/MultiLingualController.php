<?php
namespace common\components;

use Yii;
use yii\web\HttpException;

class MultiLingualController extends \yii\web\Controller
{
    private $languageIsSupported;

    public function init()
    {
        // Redirect default language to url without <language>
        dsf
        $this->languageIsSupported = true;
        $languageGet = $_GET['language'];
        if (isset($languageGet)) {
            if (!in_array($languageGet, Yii::$app->params['supportedLanguages'])) {
                $this->languageIsSupported = false;
            }
            Yii::$app->language = $_GET['language'];
        }
        parent::init();
    }

    public function beforeAction($action){
        if (!$this->languageIsSupported&&!$action instanceof \yii\web\ErrorAction) {
            throw new HttpException(404, 'The requested page does not exist.');
        }

        return parent::beforeAction($action);
    }
}