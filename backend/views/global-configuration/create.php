<?php

$this->title = Yii::t('backend', 'Create Configuration');
$this->params['breadcrumbs'][] = ['label' => 'Global Configuration', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', compact('globalConfiguration')); ?>
