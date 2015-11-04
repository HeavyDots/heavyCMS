<?php

namespace common\models\base;

use Yii;
use common\components\TranslateableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;


/**
 * This is the base-model class for table "blog_category".
 *
 * @property integer $id
 * @property string $identifier
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \common\models\User $createdBy
 * @property \common\models\User $updatedBy
 * @property \common\models\BlogPost[] $blogPosts
 */
class BlogCategory extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_category';
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
                    'name',
                    'slug',
                    'description',
                    'meta_description'
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
            [['identifier'], 'required'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['identifier'], 'string', 'max' => 255],
            [['identifier'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'identifier' => Yii::t('model', 'Identifier'),
            'created_by' => Yii::t('model', 'Created By'),
            'updated_by' => Yii::t('model', 'Updated By'),
            'created_at' => Yii::t('model', 'Created At'),
            'updated_at' => Yii::t('model', 'Updated At'),
        ];
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
    public function getBlogPosts()
    {
        return $this->hasMany(\common\models\BlogPost::className(), ['blog_category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(\common\models\BlogCategoryLang::className(), ['blog_category_id' => 'id']);
    }



}
