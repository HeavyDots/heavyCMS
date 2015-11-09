<?php

$this->title = Yii::t('app', 'Update Block') . ' ' . $content->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Content'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_content-header'); ?>

<?= $this->render('_form', compact('content', 'translations')); ?>
