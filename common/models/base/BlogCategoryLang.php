<?php

namespace common\models\base;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base-model class for table "blog_category_lang".
 *
 * @property integer $id
 * @property integer $blog_category_id
 * @property string $language
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $meta_description
 *
 * @property \common\models\BlogCategory $blogCategory
 */
class BlogCategoryLang extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_category_lang';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
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
            [['blog_category_id', 'language'], 'required'],
            [['blog_category_id', 'language', 'name'],
                'required',
                'on'=>'mainLanguage'
            ],
            [['blog_category_id'], 'integer'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['description'], 'compare', 'compareValue'=>'<p><br></p>', 'operator'=>'!=',
                        'on'=>'mainLanguage',
                        'message'=>Yii::t('yii', '{attribute} cannot be blank.')
            ],
            [['language'], 'string', 'max' => 6],
            [['name', 'slug', 'meta_description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'blog_category_id' => Yii::t('model', 'Blog Category'),
            'language' => Yii::t('model', 'Language'),
            'name' => Yii::t('model', 'Name'),
            'slug' => Yii::t('model', 'Slug'),
            'description' => Yii::t('model', 'Description'),
            'meta_description' => Yii::t('model', 'Meta Description'),
            'created_by' => Yii::t('model', 'Created By'),
            'updated_by' => Yii::t('model', 'Updated By'),
            'created_at' => Yii::t('model', 'Created At'),
            'updated_at' => Yii::t('model', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogCategory()
    {
        return $this->hasOne(\common\models\BlogCategory::className(), ['id' => 'blog_category_id']);
    }




}
