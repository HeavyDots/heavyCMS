<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use dmstr\widgets\Alert;
use common\models\Slider;

$this->title = Yii::t('backend/views', 'Manage Sliders');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend/views', 'Manage Sliders'), 'url' => ['index']];
?>

<?= Alert::widget() ?>

<?= Html::a('<i class="glyphicon glyphicon-plus"></i> ' .
                Yii::t('backend/views', 'Add New Slider'),
                'create', [
                        'class' => 'btn btn-primary',
                    ]); ?>

<?= GridView::widget([
        'dataProvider' => $sliderProvider,
        'filterModel' => $sliderSearch,
        'id' => 'manage-sliders-grid',
        'tableOptions' => ['class' => 'table table-striped table-bordered box box-primary'],
        'columns' => [
            'name',
            'created_by',
            'created_at',
            'updated_at',
            [
                'class' => ActionColumn::className(),
                'template' => '{edit}',
                'buttons' => [
                    'edit' => function ($url, $sliderSearch, $key){
                        return 'hola';
                    }
                ]

            ],
        ]
    ]);

?>