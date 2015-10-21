<?php

use yii\helpers\Html;

$this->title = Yii::t('backend/views', 'Update Gallery') . ' ' . $gallery->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend/views', 'Manage Galleries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', compact('gallery')); ?>
