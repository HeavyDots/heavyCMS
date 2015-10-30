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

    public $form;
    public $model;
    public $translations;
    public $fieldName;
    public $numberOfRows = 1;
    public $isHTMLEditor = false;
    private $formHasErrors = false;
    private $tabItems = [];

    public function init(){
        foreach ($this->translations as $index => $translation) {
            $fieldHasError = $this->fieldHasError($translation);
            $this->tabItems[] = [
                'label' => Yii::$app->params['frontendLanguages'][$translation->language],
                'content' => $this->getTabContent($translation, $index, $translation->language),
                'active' => $this->isActiveTab($translation, $fieldHasError),
                'linkOptions' => ['class' => $this->linkClass($translation, $fieldHasError)],
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
        $content = Html::tag('div', $label.$tabs, ['class' => 'form-group nav-tabs-custom']);
        return $content;
    }


    private function getTabContent($translation, $index, $language){
        return $this->isHTMLEditor ?
                    $this->getHTMLEditor($translation, $index, $language)
                    :
                    $this->getTextareaEditor($translation, $index, $language);
    }

    private function getTextareaEditor($translation, $index, $language){
        return $this->form->field($translation,
                                        "[{$index}]{$this->fieldName}")
                                    ->textarea([
                                        'id'    => "{$this->fieldName}-{$language}-translation",
                                        'class' => 'translation-textarea form-control',
                                        'rel'   => $language,
                                        'rows'  => $this->numberOfRows,
                                        ])
                                    ->label(false);
    }

    private function getHTMLEditor($translation, $index, $language){
        return $this->form->field($translation,
                                "[{$index}]{$this->fieldName}")->widget(Summernote::className(), [
                                    'clientOptions' => [
                                        'toolbar' => [
                                                ['style', ['bold', 'italic', 'underline', 'clear']],
                                                ['font', ['strikethrough', 'superscript', 'subscript']],
                                                ['para', ['ul', 'ol', 'paragraph']],
                                                ['misc', ['codeview']],
                                        ]
                                    ],
                                    'options' => [
                                        'class' => 'translation-textarea form-control',
                                    ]
                                ]
                            )
                            ->label(false);
    }


    private function isActiveTab($translation, $fieldHasError){
        $isMainLanguage = strtolower($translation->language) == strtolower(Yii::$app->params['appDefaultLanguage']);
        $isActiveLanguage = strtolower($translation->language) == strtolower(Yii::$app->language);
        return (($fieldHasError && $isMainLanguage) ||
                $isActiveLanguage && !$this->formHasErrors
               );
    }

    private function fieldHasError($translation){
        $fieldHasError = (count($this->form->validate($translation, [$this->fieldName])) > 0);
        if ($fieldHasError) {
            $this->formHasErrors = true;
        }
        return $fieldHasError;
    }

    private function linkClass($translation, $fieldHasError){
        $linkClass = '';
        if($fieldHasError){
            $linkClass = 'text-red';
        }
        else if(!isset($translation->{$this->fieldName})||empty($translation->{$this->fieldName})){
            $linkClass = 'text-muted';
        }
        return $linkClass;
    }
}




