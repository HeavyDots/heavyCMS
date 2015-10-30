<?php

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "content_lang".
 *
 * @property integer $id
 * @property integer $content_id
 * @property string $language
 * @property string $text
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \common\models\Content $content
 * @property \common\models\User $createdBy
 * @property \common\models\User $updatedBy
 */
class ContentLang extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content_id', 'language'], 'required'],
            [['content_id', 'language', 'text'], 'required', 'on' => 'mainLanguage'],
            [['content_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['text'], 'string'],
            [['language'], 'string', 'max' => 6]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'content_id' => Yii::t('models', 'Content ID'),
            'language' => Yii::t('models', 'Language'),
            'text' => Yii::t('models', 'Text'),
            'created_by' => Yii::t('models', 'Created By'),
            'updated_by' => Yii::t('models', 'Updated By'),
            'created_at' => Yii::t('models', 'Created At'),
            'updated_at' => Yii::t('models', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContent()
    {
        return $this->hasOne(\common\models\Content::className(), ['id' => 'content_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'updated_by']);
    }




}
