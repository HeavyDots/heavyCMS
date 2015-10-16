<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base-model class for table "source_message".
 *
 * @property integer $id
 * @property string $category
 * @property string $message
 *
 * @property \backend\models\TranslatedMessage[] $translatedMessages
 */
class SourceMessage extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'source_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message'], 'string'],
            [['category'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'category' => Yii::t('backend', 'Category'),
            'message' => Yii::t('backend', 'Source Message'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslatedMessages()
    {
        return $this->hasMany(\backend\models\TranslatedMessage::className(), ['id' => 'id']);
    }




}
