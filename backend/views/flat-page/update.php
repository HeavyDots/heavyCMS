<?php

$this->title = Yii::t('backend', 'Update Page') . ' ' . $flatPage->name;
$this->params['breadcrumbs'][] = ['label' => 'Page', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', compact('flatPage')); ?>
