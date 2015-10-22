<?php

$this->title = Yii::t('backend', 'Update Configuration') . ' ' . $globalConfiguration->name;
$this->params['breadcrumbs'][] = ['label' => 'Global Configuration', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', compact('globalConfiguration')); ?>
