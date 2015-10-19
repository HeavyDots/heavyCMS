<?php
/*TODO: Configure FileUploadUI to preview files.
https://github.com/2amigos/yii2-file-upload-widget
*/
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use dosamigos\fileupload\FileUploadUI;

// use https://github.com/2amigos/yii2-file-input-widget and if it works, delete yii2-file-upload-widget
asdf


$this->title = Yii::t('backend/views', 'Create Slider');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend/views', 'Manage Sliders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Yii::t('backend/views', 'New Slider') ?></h3>
        </div>
        <?php $form = ActiveForm::begin([
                'id' => 'slider',
                'enableClientValidation' => true,
                'errorSummaryCssClass' => 'error-summary alert alert-error',
            ]);
        ?>
        <div class="box-body col-md-6">
            <?= $form->field($slider, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
            <?= FileUploadUI::widget([
                'model' => $slider,
                'attribute' => 'name',
                'url' => ['media/upload', 'id' => 1],
                'gallery' => true,
                'fieldOptions' => [
                        'accept' => 'image/*'
                ],
                'clientOptions' => [
                        'maxFileSize' => 2000000
                ],
                // ...
                'clientEvents' => [
                    'fileuploaddone' => 'function(e, data) {
                                            console.log(e);
                                            console.log(data);
                                        }',
                    'fileuploadfail' => 'function(e, data) {
                                            console.log(e);
                                            console.log(data);
                                        }',
                ],
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