<?php

namespace common\models\base;

use Yii;

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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'lastname'], 'required'],
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
            'id' => Yii::t('backend', 'ID'),
            'user_id' => Yii::t('backend', 'User ID'),
            'name' => Yii::t('backend', 'Name'),
            'lastname' => Yii::t('backend', 'Lastname'),
            'avatar' => Yii::t('backend', 'Avatar'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated Ad'),
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
