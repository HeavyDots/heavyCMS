<?php

use yii\helpers\Html;

$this->title = Yii::t('backend/views', 'Update Slider') . ' ' . $slider->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend/views', 'Manage Sliders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', compact('slider')); ?>
