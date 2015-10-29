<?php
namespace backend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\bootstrap\Tabs;

use Zelenin\yii\widgets\Summernote\Summernote;

/*TODO: Associate tab fields with a form so an error can be raised and displayed */
/*TODO: Change Summernote Bold, Italic, etc markup i.e.: "<span style="font-weight: bold;">" */

class LanguageTabs extends Widget{

    public $model;
    public $fieldName;
    public $numberOfRows = 1;
    public $isHTMLEditor = false;
    private $tabItems = [];

    public function init(){
        foreach (Yii::$app->params['frontendLanguages'] as $languageCode => $languageName ) {
            $this->model->setLanguage($languageCode);
            $emptyTranslationMark = (!isset($this->model->{$this->fieldName})||empty($this->model->{$this->fieldName})) ? '*' : '';

            $this->tabItems[] = [
                'label' => $languageName . "$emptyTranslationMark",
                'content' => $this->getTabContent($languageCode),
                'active' => ($languageCode == Yii::$app->language),
            ];
        }
        parent::init();
    }

    public function run(){
        $label = Html::label($this->model->getAttributeLabel($this->fieldName), $this->fieldName, ['class' => 'control-label']);
        $tabs = Tabs::widget([
            'encodeLabels' => false,
            'items' => $this->tabItems,
            'options' => [
                'class' => 'translation-tabs'
            ],
        ]);
        $content = Html::tag('div', $label.$tabs, ['class' => 'form-group']);
        return $content;
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
                            ['misc', ['codeview']],
                    ]
                ]
            ]);
        }

        return $tabContent;
    }
}




