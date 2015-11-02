<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;

use backend\widgets\LanguageTabs;
?>

<div class="blog-post-form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Yii::t('app', 'Fill Blog Post Data') ?></h3>
        </div>
        <?php $form = ActiveForm::begin([
                'id' => 'blog-post',
                'enableClientValidation' => true,
                'errorSummaryCssClass' => 'error-summary alert alert-error',
            ]);
        ?>
        <div class="box-body col-md-7">
            <?php if (!$blogPost->isNewRecord): ?>
                <?=
                    LanguageTabs::widget([
                        'form' => $form,
                        'model' => $blogPost,
                        'fieldName' => 'title',
                        'translations' => $translations,
                    ]);
                ?>
                <?=
                    LanguageTabs::widget([
                        'form' => $form,
                        'model' => $blogPost,
                        'fieldName' => 'meta_description',
                        'translations' => $translations,
                    ]);
                ?>
                <?=
                    LanguageTabs::widget([
                        'form' => $form,
                        'model' => $blogPost,
                        'fieldName' => 'text',
                        'translations' => $translations,
                        'numberOfRows' => 10,
                        'isHTMLEditor' => true,
                    ]);
                ?>
            <?php endif ?>
            <?=
                $form->field($blogPost, 'is_published')->checkbox();
            ?>
        </div>
        <div class="clearfix"></div>
        <div class="box-footer">
            <?= Html::submitButton(
                    '<span class="glyphicon glyphicon-check"></span> ' .
                    ($blogPost->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save')),
                    [
                        'id' => 'save-' . $blogPost->formName(),
                        'class' => 'btn btn-success'
                    ]
                );
            ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>