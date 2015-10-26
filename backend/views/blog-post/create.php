<?php

$this->title = Yii::t('backend', 'Create Blog Post');
$this->params['breadcrumbs'][] = ['label' => 'Blog Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', compact('blogPost')); ?>
