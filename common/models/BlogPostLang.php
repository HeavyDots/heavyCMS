<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use \common\models\base\BlogPostLang as BaseBlogPostLang;

/**
 * This is the model class for table "blog_post_lang".
 */
class BlogPostLang extends BaseBlogPostLang
{
    public function behaviors()
    {
        $newBehaviors = [
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
        return array_merge(parent::behaviors(), $newBehaviors);
    }
}
