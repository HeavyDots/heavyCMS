<?php

$this->title = Yii::t('app', 'Update Page') . ' ' . $flatPage;
$this->params['breadcrumbs'][] = ['label' => 'Page', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_content-header'); ?>

<?= $this->render('_form', compact('flatPage','translations')); ?>
