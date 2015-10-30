<?php

$this->title = Yii::t('backend', 'Update Content') . ' ' . $content->name;
$this->params['breadcrumbs'][] = ['label' => 'Content', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', compact('content', 'translations')); ?>
