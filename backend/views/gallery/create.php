<?php

$this->title = Yii::t('backend/views', 'Create Gallery');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend/views', 'Galleries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', compact('gallery')); ?>
