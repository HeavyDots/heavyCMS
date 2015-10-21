<?php
namespace common\models;

use Yii;
use common\models\base\User as BaseUser;

class User extends BaseUser{

    public function getFullName(){
        return $this->userProfile->name . ' ' . $this->userProfile->lastname;
    }

}
