<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use common\components\TranslateableBehavior;

/**
 * This is the base-model class for table "blog_post".
 *
 * @property integer $id
 * @property integer $is_published
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \common\models\User $createdBy
 * @property \common\models\User $updatedBy
 */
class BlogPost extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_post';
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'translatable' => [
                'class' => TranslateableBehavior::className(),
                // in case you renamed your relation, you can setup its name
                // 'relation' => 'translations',
                'translationAttributes' => [
                    'slug',
                    'title',
                    'meta_description',
                    'text',
                ]
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
            [['is_published', 'blog_category_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'blog_category_id' => Yii::t('model', 'Blog Category ID'),
            'featured_image' => Yii::t('model', 'Featured Image'),
            'is_published' => Yii::t('model', 'Is Published'),
            'created_by' => Yii::t('model', 'Created By'),
            'updated_by' => Yii::t('model', 'Updated By'),
            'created_at' => Yii::t('model', 'Created At'),
            'updated_at' => Yii::t('model', 'Updated At'),
            'title' => Yii::t('model', 'Title')
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogCategory()
    {
        return $this->hasOne(\common\models\BlogCategory::className(), ['id' => 'blog_category_id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(\common\models\BlogPostLang::className(), ['blog_post_id' => 'id']);
    }



}
