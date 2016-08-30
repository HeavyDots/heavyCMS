<?php
namespace backend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\bootstrap\Tabs;

use Zelenin\yii\widgets\Summernote\Summernote;

/*TODO: Change Summernote Bold, Italic, etc markup i.e.: "<span style="font-weight: bold;">" */

class LanguageTabs extends Widget{

    public $form;
    public $model;
    public $translations;
    public $fieldName;
    public $numberOfRows = 1;
    public $isHTMLEditor = false;
    public $showLaguageCodeAsLabel = false;
    public $allowHTMLEditorToUploadImages = false;
    public $uploadImageUrl = '';
    private $_anyTabWithError = false;
    private $_anyTranslationWithError = false;
    private $_tabItems = [];

    public function init(){
        foreach ($this->translations as $index => $translation) {
            $languageTabHasError = false;
            
            if (!empty(Yii::$app->request->post())) {
              $languageTabHasError = $this->languageTabHasError($translation);
              if (!$translation->validate()) {
                  $this->_anyTranslationWithError = true;
              }
            }
            
            $label = $this->getLabelForTab($translation);
            $this->_tabItems[] = [
                'label' => $label,
                'content' => $this->getTabContent($translation, $index, $translation->language),
                'active' => $this->isActiveTab($translation, $languageTabHasError),
                'linkOptions' => ['class' => $this->linkClass($translation, $languageTabHasError)],
            ];
        }
        parent::init();
    }

    public function run(){
        $label = Html::activeLabel($this->translations[0], $this->fieldName, ['class' => 'control-label']);
        $tabs = Tabs::widget([
            'encodeLabels' => false,
            'items' => $this->_tabItems,
            'options' => [
                'class' => 'translation-tabs'
            ],
        ]);
        $content = Html::tag('div', $label.$tabs, ['class' => 'form-group nav-tabs-custom language-tabs']);
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
        $toolbar = [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['misc', ['codeview']],
        ];
        $toolbar = $this->allowHTMLEditorToUploadImages ? array_merge($toolbar, [['insert', ['picture']]]) : $toolbar;
        $callbackOnImageUpload = "function(files) {
          var editorHTML = $(this);
          var data = new FormData();
          data.append('fileUploaded', files[0]);
          $.ajax({
            url: '{$this->uploadImageUrl}',
            method: 'POST',
            data: data,
            processData: false,
            contentType: false,
            success: function(data) {
                var imgURL = data.url;
                editorHTML.summernote('insertImage', imgURL);
            }
          });
        }";
        $htmlEditor = $this->form->field($translation,
                                "[{$index}]{$this->fieldName}")->widget(Summernote::className(), [
                                    'clientOptions' => [
                                        'toolbar' => $toolbar,
                                        'onImageUpload' => new JsExpression($callbackOnImageUpload),
                                    ],
                                    'options' => [
                                        'class' => 'translation-summernote form-control',
                                    ]
                                ]
                            )
                            ->label(false);
        return  $htmlEditor;
    }


    private function isActiveTab($translation, $languageTabHasError){
        $isMainLanguage = strtolower($translation->language) == strtolower(Yii::$app->params['appMainLanguage']);
        $isActiveLanguage = strtolower($translation->language) == strtolower(Yii::$app->language);
        return (($languageTabHasError && $isMainLanguage) ||
                ($isActiveLanguage && !$this->_anyTabWithError && !$this->_anyTranslationWithError)
               );
    }

    private function languageTabHasError($translation){
        $languageTabHasError = (count($this->form->validate($translation, [$this->fieldName])) > 0);
        if ($languageTabHasError) {
            $this->_anyTabWithError = true;
        }
        return $languageTabHasError;
    }

    private function linkClass($translation, $languageTabHasError){
        $linkClass = $translation->language;
        if($languageTabHasError){
            $linkClass .= ' text-red';
        }
        else if($this->isEmptyField($translation)){
            $linkClass .= ' text-muted';
        }
        return $linkClass;
    }

    private function isEmptyField($translation){
        return (!isset($translation->{$this->fieldName})||
                empty($translation->{$this->fieldName}) ||
                $translation->{$this->fieldName}=='<p><br></p>'
                );
    }

    private function getLabelForTab($translation){
        return $this->showLaguageCodeAsLabel ?
                    $translation->language
                    :
                    Yii::$app->params['frontendLanguages'][$translation->language];
    }
}




