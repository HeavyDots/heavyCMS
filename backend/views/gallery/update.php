<?php

$this->title = Yii::t('backend/views', 'Update Gallery') . ' ' . $gallery->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend/views', 'Galleries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', compact('gallery')); ?>
