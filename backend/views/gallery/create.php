<?php

use yii\helpers\Html;

$this->title = Yii::t('backend/views', 'Create Gallery');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend/views', 'Manage Galleries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', compact('gallery')); ?>
