<?php
namespace common\models;

use Yii;
use common\models\base\User as BaseUser;
use common\models\UserProfile;

class User extends BaseUser{

    public function afterSave($insert, $changedAttributes){
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
            $userProfile = new UserProfile;
            $userProfile->name = $this->username;
            $this->link('userProfile', $userProfile);
        }
    }

    public function getFullName(){
        return $this->userProfile->name . ' ' . $this->userProfile->lastname;
    }

}
