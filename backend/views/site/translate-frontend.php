<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use dmstr\widgets\Alert;
use backend\models\SourceMessage;

$this->title = Yii::t('backend/views', 'Translate Frontend');
?>

<?= Alert::widget(); ?>

<?= GridView::widget([
        'dataProvider' => $sourceMessageProvider,
        'filterModel' => $sourceMessageSearch,
        'id' => 'translate-frontend-grid',
        'tableOptions' => ['class' => 'table table-striped table-bordered box box-primary'],
        'columns' => [
            [
                'attribute' => 'message',
                'format' => 'raw',
                'contentOptions' => [
                    'class' => 'source-message',
                ]
            ],
            [
                'label' => Yii::t('backend', 'Message Translations'),
                'format' => 'raw',
                'headerOptions' => [
                    'width' => '400',
                ],
/*                'contentOptions' => [
                    'class' => 'translation-tabs tabs-mini',
                ],*/
                'value' => function ($model, $key, $index, $column) {
                    return $this->render('_message-tabs', [
                        'model'     => $model,
                        'key'       => $key,
                        'index'     => $index,
                        'column'    => $column,
                    ]);
                },
            ],
            [
                'attribute' => 'category',
                'contentOptions' => [
                    'class' => 'text-center',
                ],
                'filter' => Html::activeDropDownList($sourceMessageSearch, 'category',
                                    SourceMessage::getAllCategoriesAsArray(),
                                    [
                                        'class'=>'form-control',
                                        'prompt' => Yii::t('backend','All')
                                    ]
                                ),
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{save}',
                'buttons' => [
                    'save' => function ($url, $sourceMessageSearch, $key) {
                        return Html::a('<i class="glyphicon glyphicon-floppy-disk"></i> ' . Yii::t('backend', 'Save'), '#', [
                            'class'                 => 'btn btn-success btn-translation-save',
                            'title'                 => Yii::t('backend', 'Save'),
                        ]);
                    },
                ],
            ],
        ]

    ]);
    // Create submit button

?>