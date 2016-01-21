<?php

namespace frontend\components;

use Yii;

use yii\web\UrlRuleInterface;
use yii\base\Object;

use common\models\FlatPage;

class FlatPageUrlRule extends Object implements UrlRuleInterface
{

    public function createUrl($manager, $route, $params)
    {
        if ($route === 'flat-page/index') {
            if (isset($params['slug'])) {
                return $params['slug'];
            }
        }
        return false;  // this rule does not apply
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        /*
        * https://github.com/yiisoft/yii2/blob/master/docs/guide/runtime-routing.md#creating-rule-classes-
        * The preg_match of: http://heavycms.dev/es-ES/page
        *    array
        *    0 => string 'es-ES/page'
        *    1 => string 'es-ES'
        *    2 => string '/page'
        *    3 => string 'page'
        */
        if (preg_match('%^([a-z][-a-zA-Z0-9]*)(/([a-z][-a-z0-9]*))?$%', $pathInfo, $matches)) {
            $slug = $matches[1];
            $language = null;
            if (isset($matches[3])) {
                $slug = $matches[3];
                $language = $matches[1];
            }
            $flatPage = FlatPage::findBySlug($slug, $language);

            if(isset($flatPage)) {
                $params['slug'] = $slug;
                $params['url'] = $flatPage->url;
                return ['flat-page/index', $params];
            }
        }
        return false;  // this rule does not apply
    }
}