<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;
use kartik\file\FileInput;

use backend\widgets\LanguageTabs;

use common\models\BlogCategory;
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
                'options' => ['enctype'=>'multipart/form-data'],
            ]);
        ?>
        <div class="box-body col-md-7">
            <?= $form->field($blogPost, 'blog_category_id')->dropDownList(BlogCategory::getMappedArray()) ?>
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
                        'numberOfRows' => 3,
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
                        'allowHTMLEditorToUploadImages' => true,
                        'uploadImageUrl' => Url::toRoute(['/blog-post/upload-image', 'blogPostId' => $blogPost->id]),
                    ]);
                ?>
            <?php endif ?>
            <?=
                $form->field($blogPost, 'is_published')->checkbox();
            ?>
            <?= $form->field($blogPost, 'uploadedFeaturedImage',
                ['options'=>['class'=>'col-md-11 image-file-upload']])->widget(
                    FileInput::classname(),[
                        'options' => ['multiple' => false, 'accept' => 'image/*'],
                        'pluginOptions' => [
                            'defaultPreviewContent' => Html::img($blogPost->getFullUrlFeaturedImage()),
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