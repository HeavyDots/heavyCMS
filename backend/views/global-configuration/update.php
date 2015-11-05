<?php

$this->title = Yii::t('app', 'Update Configuration') . ' ' . $globalConfiguration->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Global Configuration'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_content-header'); ?>

<?= $this->render('_form', compact('globalConfiguration')); ?>
