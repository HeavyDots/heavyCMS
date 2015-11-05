<?php

$this->title = Yii::t('app', 'Update Page') . ' ' . $flatPage;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Page'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_content-header'); ?>

<?= $this->render('_form', compact('flatPage','translations')); ?>
