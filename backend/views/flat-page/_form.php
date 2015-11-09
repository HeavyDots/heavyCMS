<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;

use backend\widgets\LanguageTabs;
?>

<div class="flat-page-form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Yii::t('app', 'Fill Page Data') ?></h3>
        </div>
        <?php $form = ActiveForm::begin([
                'id' => 'flat-page',
                'enableClientValidation' => true,
                'errorSummaryCssClass' => 'error-summary alert alert-error',
            ]);
        ?>
        <div class="box-body col-md-7">
            <?php if (!$flatPage->isNewRecord): ?>
                <?=
                    LanguageTabs::widget([
                        'form' => $form,
                        'model' => $flatPage,
                        'fieldName' => 'title',
                        'translations' => $translations,
                    ]);
                ?>
                <?=
                    LanguageTabs::widget([
                        'form' => $form,
                        'model' => $flatPage,
                        'fieldName' => 'meta_description',
                        'translations' => $translations,
                        'numberOfRows' => 2,
                    ]);
                ?>
                <?=
                    LanguageTabs::widget([
                        'form' => $form,
                        'model' => $flatPage,
                        'fieldName' => 'anchor',
                        'translations' => $translations,
                    ]);
                ?>
            <?php endif ?>
            <?= $form->field($flatPage, 'url')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="clearfix"></div>
        <div class="box-footer">
            <?= Html::submitButton(
                    '<span class="glyphicon glyphicon-check"></span> ' .
                    ($flatPage->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save')),
                    [
                        'id' => 'save-' . $flatPage->formName(),
                        'class' => 'btn btn-success'
                    ]
                );
            ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>