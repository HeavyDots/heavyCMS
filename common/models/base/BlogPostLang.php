<?php

namespace common\models\base;

use Yii;

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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slug', 'blog_post_id', 'language', 'title', 'meta_description', 'text'], 'required'],
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
            'id' => Yii::t('models', 'ID'),
            'slug' => Yii::t('models', 'Slug'),
            'blog_post_id' => Yii::t('models', 'Blog Post ID'),
            'language' => Yii::t('models', 'Language'),
            'title' => Yii::t('models', 'Title'),
            'meta_description' => Yii::t('models', 'Meta Description'),
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
