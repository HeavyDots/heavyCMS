<?php

namespace common\models;

use Yii;
use yii\helpers\Html;
use yii\behaviors\TimestampBehavior;

use \common\models\base\UserProfile as BaseUserProfile;

/**
 * This is the model class for table "user_profile".
 */
class UserProfile extends BaseUserProfile
{

    protected $avatarDirectory = 'user-avatars/';
    protected $avatarFullDirectory;
    protected $avatarURL;
    protected $defaultAvatar;
    public $uploadedAvatar;

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }


    public function init(){
        $this->avatarFullDirectory = Yii::$app->params['backendUploadDirectory'] . $this->avatarDirectory;
        $this->avatarURL = sprintf('%s%s%s',
                            Yii::$app->params['backendURL'],
                            Yii::$app->params['uploadDirectoryForURL'],
                            $this->avatarDirectory);
        $this->defaultAvatar = 'default_avatar_male.jpg';
    }

    public function attributeLabels(){
        $parentAttributeLabels = parent::attributeLabels();
        $parentAttributeLabels['uploadedAvatar'] = Yii::t('backend', 'Avatar');
        return $parentAttributeLabels;
    }

    public function getFullUrlAvatar(){
        $avatar = isset($this->avatar)? $this->avatar : $this->defaultAvatar;
        return $this->avatarURL . $avatar;
    }

    /*TODO: Extract save model avatar name. This function must save images on disk and nothing more. */
    public function saveAvatarToDisk(){
        $uploadedOK = false;
        if (isset($this->uploadedAvatar)) {
            $stringToHash = sprintf('%d-%s%s-%s.%s',
                                        $this->id,
                                        $this->name,
                                        $this->lastname,
                                        $this->uploadedAvatar->baseName,
                                        $this->uploadedAvatar->extension);
            $hashedFileName = hash('sha256', $stringToHash) . '.' .$this->uploadedAvatar->extension;
            $fileFullPath = $this->avatarFullDirectory . $hashedFileName;
            $this->uploadedAvatar->saveAs($fileFullPath);

            /*TODO: Make better controll over upload errors */
            if ($this->uploadedAvatar->error==0) {
                $this->avatar = $hashedFileName;
                $this->save();
                $uploadedOK = true;
            }
        }

        return $uploadedOK;
    }
}
