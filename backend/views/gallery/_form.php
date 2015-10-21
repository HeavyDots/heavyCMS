<?php
/*TODO: Add possibility of deactivate/activate Gallery image, and delete Gallery image. Deactivate is a Must Have feature, delete is a Good To Have feature */
/*TODO: Delete debug data: $gallery->getImageNextPosition(); and 'hideInput' => false,*/
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
use kartik\sortinput\SortableInput;
?>

<?=
    $gallery->getImageNextPosition();
?>
<div class="gallery-form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Yii::t('backend/views', 'Fill Gallery Data') ?></h3>
        </div>
        <?php $form = ActiveForm::begin([
                'id' => 'gallery',
                'enableClientValidation' => true,
                'errorSummaryCssClass' => 'error-summary alert alert-error',
                'options' => ['enctype'=>'multipart/form-data'],
            ]);
        ?>
        <div class="box-body col-md-6">
            <?= $form->field($gallery, 'name')->textInput(['maxlength' => true]) ?>
            <?php if (!$gallery->isNewRecord): ?>
                <div id="gallery-images-sortable">
                <?=
                    SortableInput::widget([
                        'name' => 'galleryImagesOrder',
                        'items' => $gallery->getGalleryImagesForSortableWidget(),
                        'value' => $gallery->getOrderOfGalleryImagesForSortableWidget(),
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
                $form->field($gallery, 'uploadedImages[]')->widget(FileInput::classname(), [
                    'options' => ['multiple' => true, 'accept' => 'image/*'],
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
                    ($gallery->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save')),
                    [
                        'id' => 'save-' . $gallery->formName(),
                        'class' => 'btn btn-success'
                    ]
                );
            ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>