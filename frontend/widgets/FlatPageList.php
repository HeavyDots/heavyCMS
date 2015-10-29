<?php
namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;

use common\models\FlatPage;

class FlatPageList extends Widget{
    public $flatPageList;
    public $htmlClass = '';

    public function init(){
        $this->flatPageList = FlatPage::find()->all();
        parent::init();
    }

    public function run(){
        return Html::ul($this->flatPageList, [
                                'class' => $this->htmlClass,
                                'item' => function ($flatPage, $index){
            return Html::tag('li', Html::a($flatPage->anchor, [$flatPage->url]));
        }]);
    }
}
