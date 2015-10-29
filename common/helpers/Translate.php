<?php
namespace common\helpers;

use common\models\Content;

class Translate{
    public static function t($flatPageUrl, $contentName){
        $content = Content::find()
                    ->joinWith('flatPage')
                    ->where(['content.name' => $contentName])
                    ->andWhere(['flat_page.url' => $flatPageUrl])
                    ->one();

        return isset($content) ? $content->text : '';
    }
}