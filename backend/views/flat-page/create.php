<?php

$this->title = Yii::t('app', 'Create Page');
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', compact('flatPage')); ?>
