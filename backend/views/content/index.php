<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use dmstr\widgets\Alert;


$this->title = Yii::t('backend', 'Contents');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= Alert::widget() ?>

<p class="pull-left">
    <?= Html::a('<i class="glyphicon glyphicon-plus"></i> ' .
        Yii::t('backend/views', 'Add New Content'),
        'create', [
                'class' => 'btn btn-primary',
    ]); ?>
</p>

<div class="clearfix"></div>

<?= GridView::widget([
    'dataProvider' => $contentProvider,
    'filterModel' => $contentSearch,
    'id' => 'content-grid',
    'tableOptions' => ['class' => 'table table-striped table-bordered box box-primary'],
    'columns' => [
        'flatPage',
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function($content){
                return Html::a($content->name, ['update', 'id'=>$content->id]);
            }
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
