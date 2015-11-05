<?php

$this->title = Yii::t('app', 'Create Configuration');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Global Configuration'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_content-header'); ?>

<?= $this->render('_form', compact('globalConfiguration')); ?>
