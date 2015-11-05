<?php

$this->title = Yii::t('app', 'Update Blog Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blog Post'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_content-header'); ?>

<?= $this->render('_form', compact('blogPost', 'translations')); ?>
