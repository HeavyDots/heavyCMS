<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "user_profile".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $lastname
 * @property string $avatar
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \common\models\User $user
 */
class UserProfile extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_profile';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'lastname', 'avatar'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'user_id' => Yii::t('model', 'User ID'),
            'name' => Yii::t('model', 'Name'),
            'lastname' => Yii::t('model', 'Lastname'),
            'avatar' => Yii::t('model', 'Avatar'),
            'created_at' => Yii::t('model', 'Created At'),
            'updated_at' => Yii::t('model', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'user_id']);
    }




}
