<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;
use kartik\file\FileInput;

use backend\widgets\LanguageTabs;
?>

<div class="blog-category-form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Yii::t('app', 'Fill Blog Category Data') ?></h3>
        </div>
        <?php $form = ActiveForm::begin([
                'id' => 'blog-category',
                'enableClientValidation' => true,
                'errorSummaryCssClass' => 'error-summary alert alert-error',
                'options' => ['enctype'=>'multipart/form-data'],
            ]);
        ?>

        <div class="box-body col-md-7">
            <?=
                LanguageTabs::widget([
                    'form' => $form,
                    'model' => $blogCategory,
                    'fieldName' => 'name',
                    'translations' => $translations,
                ]);
            ?>
            <?=
                LanguageTabs::widget([
                    'form' => $form,
                    'model' => $blogCategory,
                    'fieldName' => 'description',
                    'translations' => $translations,
                    'numberOfRows' => 10,
                    'isHTMLEditor' => true,
                ]);
            ?>
            <?=
                LanguageTabs::widget([
                    'form' => $form,
                    'model' => $blogCategory,
                    'fieldName' => 'meta_description',
                    'translations' => $translations,
                ]);
            ?>
        </div>
        <div class="clearfix"></div>
        <div class="box-footer">
            <?= Html::submitButton(
                    '<span class="glyphicon glyphicon-check"></span> ' .
                    ($blogCategory->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save')),
                    [
                        'id' => 'save-' . $blogCategory->formName(),
                        'class' => 'btn btn-success'
                    ]
                );
            ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>