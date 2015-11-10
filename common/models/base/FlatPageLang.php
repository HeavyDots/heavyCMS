<?php

namespace common\models\base;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

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

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'anchor',
            ],
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
            [
            'class' => BlameableBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language'], 'required'],
            [['language', 'title', 'meta_description', 'anchor'],
                'required',
                'on' => 'mainLanguage'
            ],
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
            'id' => Yii::t('model', 'ID'),
            'flat_page_id' => Yii::t('model', 'Flat Page ID'),
            'language' => Yii::t('model', 'Language'),
            'title' => Yii::t('model', 'Name'),
            'meta_description' => Yii::t('model', 'Meta Description'),
            'anchor' => Yii::t('model', 'Anchor'),
            'created_by' => Yii::t('model', 'Created By'),
            'updated_by' => Yii::t('model', 'Updated By'),
            'created_at' => Yii::t('model', 'Created At'),
            'updated_at' => Yii::t('model', 'Updated At'),
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
