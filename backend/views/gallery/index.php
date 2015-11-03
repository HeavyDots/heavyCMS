<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use dmstr\widgets\Alert;

$this->title = Yii::t('app', 'Galleries');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
?>

<?= $this->render('_content-header'); ?>

<?= Alert::widget() ?>

<p class="pull-left">
    <?= Html::a('<i class="glyphicon glyphicon-plus"></i> ' .
        Yii::t('app', 'Add New Gallery'),
        'create', [
                'class' => 'btn btn-primary',
    ]); ?>
</p>

<div class="clearfix"></div>

<?= GridView::widget([
    'dataProvider' => $galleryProvider,
    'filterModel' => $gallerySearch,
    'id' => 'manage-galleries-grid',
    'tableOptions' => ['class' => 'table table-striped table-bordered box box-primary'],
    'columns' => [
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function($gallery){
                return Html::a($gallery->name, ['update', 'id'=>$gallery->id]);
            }
        ],
        'slug',
        'created_by',
        'created_at:datetime',
        'updated_at:datetime',
        [
            'class' => ActionColumn::className(),
            'template' => '{update}',
        ],
    ]
]);

?>