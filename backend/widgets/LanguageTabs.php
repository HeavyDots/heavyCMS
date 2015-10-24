<?php
namespace backend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\bootstrap\Tabs;

use Zelenin\yii\widgets\Summernote\Summernote;

/*TODO: Associate tab fields with a form so an error can be raised and displayed */

class LanguageTabs extends Widget{

    public $model;
    public $fieldName;
    public $numberOfRows = 1;
    public $isHTMLEditor = false;
    private $tabItems = [];

    public function init(){
        foreach ( array_keys(Yii::$app->params['frontendLanguages']) as $language ) {
            $this->model->setLanguage($language);
            $emptyTranslationMark = (!isset($this->model->{$this->fieldName})||empty($this->model->{$this->fieldName})) ? '*' : '';

            $this->tabItems[] = [
                'label' => '<b>' . strtoupper($language) . "$emptyTranslationMark </b>",
                'content' => $this->getTabContent($language),
                'active' => ($language == Yii::$app->language),
            ];
        }
        parent::init();
    }

    public function run(){
        return Html::label($this->model->getAttributeLabel($this->fieldName), $this->fieldName, ['class' => 'control-label'])
            . Tabs::widget([
            'encodeLabels' => false,
            'items' => $this->tabItems,
        ]);
    }

    private function getTabContent($language){
        $tabContent = Html::textarea("Translations[$language][$this->fieldName]",
                        $this->model->{$this->fieldName}, [
                            'id'    => "{$this->fieldName}-{$language}-translation",
                            'class' => 'translation-textarea form-control',
                            'rel'   => $language,
                            'rows'  => $this->numberOfRows,
                        ]);

        if ($this->isHTMLEditor) {
            $tabContent = Summernote::widget([
                'name' => "Translations[$language][$this->fieldName]",
                'value' => $this->model->{$this->fieldName},
                'id'    => "{$this->fieldName}-{$language}-translation",
                'class' => 'translation-textarea form-control',
                'clientOptions' => [
                    'toolbar' => [
                            ['style', ['bold', 'italic', 'underline', 'clear']],
                            ['font', ['strikethrough', 'superscript', 'subscript']],
                            ['para', ['ul', 'ol', 'paragraph']],
                    ]
                ]
            ]);
        }

        return $tabContent;
    }
}




