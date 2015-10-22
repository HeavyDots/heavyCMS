<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use common\models\FlatPage;
// Create multilingual form for flat page (title, meta_description, anchor)
// Create multilingual form for content (text)
fsd
?>

<div class="content-form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Yii::t('backend/views', 'Fill Content Data') ?></h3>
        </div>
        <?php $form = ActiveForm::begin([
                'id' => 'content',
                'enableClientValidation' => true,
                'errorSummaryCssClass' => 'error-summary alert alert-error',
            ]);
        ?>
        <div class="box-body col-md-6">
            <?= $form->field($content, 'flat_page_id')->dropDownList(FlatPage::getMappedArray()) ?>
            <?= $form->field($content, 'name')->textInput(['maxlength' => true]) ?>
        </div>
         <?php echo $form->errorSummary($content); ?>
        <div class="clearfix"></div>
        <div class="box-footer">
            <?= Html::submitButton(
                    '<span class="glyphicon glyphicon-check"></span> ' .
                    ($content->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save')),
                    [
                        'id' => 'save-' . $content->formName(),
                        'class' => 'btn btn-success'
                    ]
                );
            ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>