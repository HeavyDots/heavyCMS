<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use common\components\MultiLingualController;
use common\models\LoginForm;
use backend\models\SourceMessage;
use backend\models\SourceMessageSearch;

/**
 * Site controller
 */
class SiteController extends MultiLingualController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'about-us', 'translate-frontend'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
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
        return $this->render('index');
    }

    public function actionTranslateFrontend(){
        // Create translation field on grid to allow translation to multiple languages
        asdf
        $sourceMessageSearch = new SourceMessageSearch;
        $sourceMessageProvider = $sourceMessageSearch->search($_GET);
        return $this->render('translate-frontend', compact('sourceMessageProvider',
                                                            'sourceMessageSearch'));
    }

    public function actionAboutUs(){
        return $this->render('about-us');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
