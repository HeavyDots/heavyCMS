<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

use common\models\FlatPage;

class FlatPageList extends Widget{
    public $flatPageList;
    public $activeLiClass = 'active';
    public $htmlClass = '';

    public function init(){
        $this->flatPageList = FlatPage::find()
                                ->where(['is_active'=>true])
                                ->all();
        parent::init();
    }

    public function run(){
        return Html::ul($this->flatPageList, [
                                'class' => $this->htmlClass,
                                'item' => function ($flatPage, $index){
                                    $class = ($flatPage->url == Yii::$app->controller->action->id) ?
                                            $this->activeLiClass :
                                            null;
            return Html::tag('li', Html::a($flatPage->anchor, $flatPage->getRoute()), ['class'=>$class]);
        }]);
    }
}
