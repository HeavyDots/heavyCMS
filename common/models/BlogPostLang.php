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
}
