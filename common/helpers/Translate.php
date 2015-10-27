<?php
namespace common\helpers;

use common\models\Content;

class Translate{
    public static function t($flatPageName, $contentName){
        $content = Content::find()
                    ->joinWith('flatPage')
                    ->where(['content.name' => $contentName])
                    ->andWhere(['flat_page.name' => $flatPageName])
                    ->one();

        return isset($content) ? $content->text : '';
    }
}