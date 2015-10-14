<?php
namespace common\components;

use Yii;
use yii\web\UrlRule;

class MultiLingualUrlRule extends UrlRule
{
    public function init()
    {
        if ($this->pattern !== null) {
            $this->pattern = '<language>/' . $this->pattern;
        }
        parent::init();
    }
}