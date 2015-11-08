<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

use backend\widgets\LanguageTabs;
?>
<?php $form = ActiveForm::begin([
        'id' => "translate-message-".$key,
        'enableClientValidation' => true,
        'errorSummaryCssClass' => 'error-summary alert alert-error',
        'method' => 'post',
        'action' => ['site/save-translation', 'id'=>$model->id],
        'options' => ['class' => 'translate-message-form']
    ]);
?>
        <div class="row">
            <div class="col-sm-10 no-gutter">
              <?=
                LanguageTabs::widget([
                    'form' => $form,
                    'model' => $model,
                    'fieldName' => 'translation',
                    'translations' => $model->initializeTranslations(),
                    'numberOfRows' => 1,
                    'showLaguageCodeAsLabel' => true,
                ]);
                ?>
            </div>
            <div class="col-sm-2 no-gutter">
                <?=
                    Html::submitButton('<i class="glyphicon glyphicon-floppy-disk"></i> ' . Yii::t('app', 'Save'), [
                        'class' => 'btn btn-success btn-translation-save',
                        'title' => Yii::t('app', 'Save'),
                    ]);
                ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php $model->setLanguage(Yii::$app->params['appMainLanguage']) ?>
        <p><em><?= Yii::$app->params['supportedLanguages'][Yii::$app->params['appMainLanguage']] ?></em>: <?=$model->translation?></p>
<?php ActiveForm::end() ?>