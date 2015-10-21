<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;

use common\components\MultiLingualController;
use common\models\LoginForm;
use common\models\UserProfile;
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
                        'actions' => ['logout', 'index', 'about-us',
                                      'translate-frontend', 'save-translation',
                                      'user-profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'save-translation' => ['post'],
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
        $sourceMessageSearch = new SourceMessageSearch;
        $sourceMessageProvider = $sourceMessageSearch->search($_GET);
        return $this->render('translate-frontend', compact('sourceMessageProvider',
                                                            'sourceMessageSearch'));
    }

    public function actionSaveTranslation($id){
        $sourceMessage = SourceMessage::findOne($id);
        if (!isset($sourceMessage)) {
            throw new HttpException(404, Yii::t('backend/view','The requested page does not exist.'));
        }
        $sourceMessage->initTranslatedMessages();

        if ( SourceMessage::loadMultiple($sourceMessage->translatedMessages, Yii::$app->getRequest()->post())
             && SourceMessage::validateMultiple($sourceMessage->translatedMessages) )
        {
            $sourceMessage->saveTranslatedMessages();
            Yii::$app->session->setFlash('success', Yii::t('backend', 'Translations saved successfully'));
        }
        else{
            Yii::$app->session->setFlash('error', Yii::t('backend', 'Error saving translation'));
        }

        return $this->redirect(['translate-frontend']);
    }

    public function actionUserProfile(){
        $userProfile = Yii::$app->user->identity->userProfile;
        $userProfile = isset($userProfile) ? $userProfile : new UserProfile;
        $userProfile->user_id = Yii::$app->user->id;

        if ($userProfile->load($_POST)&&$userProfile->save()){
            $userProfile->uploadedAvatar = UploadedFile::getInstance($userProfile, 'uploadedAvatar');

            if($userProfile->saveAvatarToDisk()){
                Yii::$app->session->setFlash('success', Yii::t('backend', 'Profile updated successfully'));
            }
            else{
                Yii::$app->session->setFlash('error', Yii::t('backend', 'There was some error uploading your avatar Image'));
            }
            return $this->refresh();
        }
        return $this->render('user-profile', compact('userProfile'));
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
