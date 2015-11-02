<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<div class="global-configuration-form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Yii::t('app', 'Fill Configuration Data') ?></h3>
        </div>
        <?php $form = ActiveForm::begin([
                'id' => 'global-configuration',
                'enableClientValidation' => true,
                'errorSummaryCssClass' => 'error-summary alert alert-error',
            ]);
        ?>
        <div class="box-body col-md-7">
            <?= $form->field($globalConfiguration, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($globalConfiguration, 'value')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="clearfix"></div>
        <div class="box-footer">
            <?= Html::submitButton(
                    '<span class="glyphicon glyphicon-check"></span> ' .
                    ($globalConfiguration->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save')),
                    [
                        'id' => 'save-' . $globalConfiguration->formName(),
                        'class' => 'btn btn-success'
                    ]
                );
            ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>