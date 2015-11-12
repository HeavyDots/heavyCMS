<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\base\BlogCategory as BaseBlogCategory;
use common\models\traits\Translation;

/**
 * This is the model class for table "blog_category".
 */
class BlogCategory extends BaseBlogCategory
{
    use Translation;

    public static function getMappedArray(){
        $models = self::find()->all();
        return ArrayHelper::map($models, 'id', 'name');
    }

    public static function findBySlug($slug, $language = null){
        $language = isset($language) ? $language : Yii::$app->language;
        return self::find()
                ->joinWith('translations')
                ->where(['blog_category_lang.slug'=>$slug])
                ->andWhere(['blog_category_lang.language'=>$language])
                ->one();
    }
}
