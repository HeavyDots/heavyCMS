<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;

use backend\widgets\LanguageTabs;
?>

<div class="blog-post-form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Yii::t('backend/views', 'Fill Blog Post Data') ?></h3>
        </div>
        <?php $form = ActiveForm::begin([
                'id' => 'blog-post',
                'enableClientValidation' => true,
                'errorSummaryCssClass' => 'error-summary alert alert-error',
            ]);
        ?>
        <div class="box-body col-md-7">
            <?=
                LanguageTabs::widget([
                    'model' => $blogPost,
                    'fieldName' => 'title',
                ]);
            ?>
            <?=
                LanguageTabs::widget([
                    'model' => $blogPost,
                    'fieldName' => 'meta_description',
                ]);
            ?>
            <?=
                LanguageTabs::widget([
                    'model' => $blogPost,
                    'fieldName' => 'text',
                    'numberOfRows' => 10,
                    'isHTMLEditor' => true,
                ]);
            ?>
            <?=
                $form->field($blogPost, 'is_published')->checkbox();
            ?>
        </div>
         <?php echo $form->errorSummary($blogPost); ?>
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