<?php
namespace common\components;

use Yii;
use yii\web\HttpException;

class MultiLingualController extends \yii\web\Controller
{
    private $languageGet;
    private $languageIsNotSupported;

    public function init()
    {
        // This URL is not valid http://admin.heavycms.dev/es-ES/ Fix It
        $languageGet = isset($_GET['language']) ? $_GET['language'] : null;
        if (isset($languageGet)) {
            $this->languageIsNotSupported = !$this->isLanguageGetSupported($languageGet);

            $this->languageGet = $languageGet;
            Yii::$app->language = $languageGet;
        }
        parent::init();
    }

    public function beforeAction($action){
        if ($this->languageIsNotSupported&&!$action instanceof \yii\web\ErrorAction) {
            throw new HttpException(404, 'The requested page does not exist.');
        }
        if ($this->isLanguageGetTheDefaultLanguage()){
            $this->redirectToUrlWithNoLanguage($action);
        }
        return parent::beforeAction($action);
    }

    private function isLanguageGetSupported($languageGet){
        return in_array($languageGet, array_keys(Yii::$app->params['supportedLanguages']));
    }

    private function isLanguageGetTheDefaultLanguage(){
        return $this->languageGet==Yii::$app->params['appDefaultLanguage'];
    }

    private function redirectToUrlWithNoLanguage($action){
        $this->redirect([$action->id], $statusCode = 301);
    }
}