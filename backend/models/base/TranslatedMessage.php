<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base-model class for table "translated_message".
 *
 * @property integer $id
 * @property string $language
 * @property string $translation
 *
 * @property \backend\models\SourceMessage $id0
 */
class TranslatedMessage extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'translated_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'language'], 'required'],
            [['id'], 'integer'],
            [['translation'], 'string'],
            [['language'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'language' => Yii::t('backend', 'Language'),
            'translation' => Yii::t('backend', 'Translation'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSourceMessage()
    {
        return $this->hasOne(\backend\models\SourceMessage::className(), ['id' => 'id']);
    }




}
