<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dmstr\widgets\Alert;
use kartik\file\FileInput;

$this->title = Yii::t('backend/views', 'User Profile');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= Alert::widget() ?>

<div class="site-user-profile col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Yii::t('backend/views', 'Edit Your Profile') ?></h3>
        </div>
        <?php $form = ActiveForm::begin([
                'id' => 'user-profile',
                'enableClientValidation' => true,
                'errorSummaryCssClass' => 'error-summary alert alert-error',
                'options' => ['enctype'=>'multipart/form-data'],
            ]);
        ?>
        <div class="box-body col-md-6">
            <?= $form->field($userProfile, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($userProfile, 'lastname')->textInput(['maxlength' => true]) ?>
            <?= $form->field($userProfile, 'uploadedAvatar',
                ['options'=>['class'=>'col-md-11 user-avatar-upload']])->widget(
                                            FileInput::classname(),[
                                                'options' => ['multiple' => false, 'accept' => 'image/*'],
                                                'pluginOptions' => [
                                                    'defaultPreviewContent' => Html::img($userProfile->getFullUrlAvatar()),
                                                    'overwriteInitial' => true,
                                                    'showCaption' => false,
                                                    'showRemove' => true,
                                                    'showUpload' => false,
                                                    'showClose' => false,
                                                    'browseLabel' => '',
                                                    'removeLabel' => '',
                                                    'removeIcon' => '<i class="glyphicon glyphicon-remove"></i>',
                                                    'layoutTemplates' => ['main2' => '{preview} {browse} {remove}'],
                                                    'allowedFileExtensions' => ["jpg", "png", "gif"]
                                                    ]
                                                ]);
            ?>
        </div>
        <div class="clearfix"></div>
        <div class="box-footer">
            <?= Html::submitButton(
                    '<span class="glyphicon glyphicon-check"></span> ' .
                    Yii::t('app', 'Save'),
                    [
                        'id' => 'save-user-profile',
                        'class' => 'btn btn-success'
                    ]
                );
            ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<div class="clearfix"></div>