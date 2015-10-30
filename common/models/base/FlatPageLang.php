<?php

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "flat_page_lang".
 *
 * @property integer $id
 * @property integer $flat_page_id
 * @property string $language
 * @property string $title
 * @property string $meta_description
 * @property string $anchor
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \common\models\FlatPage $flatPage
 * @property \common\models\User $createdBy
 * @property \common\models\User $updatedBy
 */
class FlatPageLang extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'flat_page_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['flat_page_id', 'language'], 'required'],
            [['flat_page_id', 'language', 'title', 'meta_description', 'anchor'], 'required', 'on' => 'mainLanguage'],
            [['flat_page_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['language'], 'string', 'max' => 6],
            [['title', 'meta_description', 'anchor'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'flat_page_id' => Yii::t('models', 'Flat Page ID'),
            'language' => Yii::t('models', 'Language'),
            'title' => Yii::t('models', 'Title'),
            'meta_description' => Yii::t('models', 'Meta Description'),
            'anchor' => Yii::t('models', 'Anchor'),
            'created_by' => Yii::t('models', 'Created By'),
            'updated_by' => Yii::t('models', 'Updated By'),
            'created_at' => Yii::t('models', 'Created At'),
            'updated_at' => Yii::t('models', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlatPage()
    {
        return $this->hasOne(\common\models\FlatPage::className(), ['id' => 'flat_page_id']);
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
