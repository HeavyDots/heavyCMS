<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use dmstr\widgets\Alert;


$this->title = Yii::t('app', 'Blog Posts');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_content-header'); ?>

<?= Alert::widget() ?>

<p class="pull-left">
    <?= Html::a('<i class="glyphicon glyphicon-plus"></i> ' .
        Yii::t('app', 'New Post'),
        'create', [
                'class' => 'btn btn-primary',
    ]); ?>
</p>

<div class="clearfix"></div>

<?= GridView::widget([
    'dataProvider' => $blogPostProvider,
    'filterModel' => $blogPostSearch,
    'id' => 'content-grid',
    'tableOptions' => ['class' => 'table table-striped table-bordered box box-primary'],
    'columns' => [
        [
            'attribute' => 'title',
            'format' => 'raw',
            'value' => function($blogPost){
                return Html::a($blogPost->title, ['update', 'id'=>$blogPost->id]);
            }
        ],
        'is_published:boolean',
        [
            'attribute' => 'blogCategory.name',
            'label' => Yii::t('app', 'Blog Category')
        ],
        'created_at:datetime',
        'updated_at:datetime',
        [
            'class' => ActionColumn::className(),
            'template' => '{update}',
        ],
    ]
]);
?>
