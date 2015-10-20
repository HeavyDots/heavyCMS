<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
use kartik\sortinput\SortableInput;
?>

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Yii::t('backend/views', 'Fill Slider Data') ?></h3>
        </div>
        <?php $form = ActiveForm::begin([
                'id' => 'slider',
                'enableClientValidation' => true,
                'errorSummaryCssClass' => 'error-summary alert alert-error',
                'options' => ['enctype'=>'multipart/form-data'],
            ]);
        ?>
        <div class="box-body col-md-6">
            <?= $form->field($slider, 'name')->textInput(['maxlength' => true]) ?>
            <?php if (!$slider->isNewRecord): ?>
                <div id="slider-images-sortable">
                <?=
                    SortableInput::widget([
                        'name' => 'sliderImagesOrder',
                        'items' => $slider->getSliderImagesForSortableWidget(),
                        'value' => $slider->getOrderOfSliderImagesForSortableWidget(),
                        'hideInput' => false,
                        'sortableOptions' => [
                            'type' => 'grid',
                        ],
                    ]);
                ?>
                </div>
            <?php endif ?>
        </div>
        <div class="col-md-12">
            <?=
                $form->field($slider, 'uploadedImages[]')->widget(FileInput::classname(), [
                    'options' => ['multiple' => true],
                    'pluginOptions' => [
                        'previewFileType' => 'any',
                        'showCaption' => false,
                        'showRemove' => true,
                        'showUpload' => false
                        ]
                    ]);
            ?>
        </div>
        <div class="clearfix"></div>
        <div class="box-footer">
            <?= Html::submitButton(
                    '<span class="glyphicon glyphicon-check"></span> ' .
                    ($slider->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save')),
                    [
                        'id' => 'save-' . $slider->formName(),
                        'class' => 'btn btn-success'
                    ]
                );
            ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>