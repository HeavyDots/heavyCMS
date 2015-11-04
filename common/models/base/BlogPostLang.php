<?php

namespace common\models\base;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base-model class for table "blog_post_lang".
 *
 * @property integer $id
 * @property string $slug
 * @property integer $blog_post_id
 * @property string $language
 * @property string $title
 * @property string $meta_description
 * @property string $text
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \common\models\BlogPost $blogPost
 * @property \common\models\User $createdBy
 * @property \common\models\User $updatedBy
 */
class BlogPostLang extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_post_lang';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
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
            [['blog_post_id', 'language'], 'required'],
            [['blog_post_id', 'language', 'title', 'meta_description', 'text'],
                'required',
                'on'=>'mainLanguage'
            ],
            [['blog_post_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['text'], 'string'],
            [['slug', 'title', 'meta_description'], 'string', 'max' => 255],
            [['language'], 'string', 'max' => 6]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'slug' => Yii::t('model', 'Slug'),
            'blog_post_id' => Yii::t('model', 'Blog Post'),
            'language' => Yii::t('model', 'Language'),
            'title' => Yii::t('model', 'Title'),
            'meta_description' => Yii::t('model', 'Meta Description'),
            'text' => Yii::t('model', 'Text'),
            'created_by' => Yii::t('model', 'Created By'),
            'updated_by' => Yii::t('model', 'Updated By'),
            'created_at' => Yii::t('model', 'Created At'),
            'updated_at' => Yii::t('model', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogPost()
    {
        return $this->hasOne(\common\models\BlogPost::className(), ['id' => 'blog_post_id']);
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
