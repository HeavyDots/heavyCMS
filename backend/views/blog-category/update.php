<?php

$this->title = Yii::t('app', 'Update Blog Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blog Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_content-header'); ?>

<?= $this->render('_form', compact('blogCategory', 'translations')); ?>
