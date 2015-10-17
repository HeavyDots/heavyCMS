<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\SourceMessage;

$this->title = Yii::t('backend/views', 'Translate Frontend');
?>

<?= GridView::widget([
        'dataProvider' => $sourceMessageProvider,
        'filterModel' => $sourceMessageSearch,
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
                'filter' => Html::activeDropDownList($sourceMessageSearch, 'category',
                                    SourceMessage::getAllCategoriesAsArray(),
                                    [
                                        'class'=>'form-control',
                                        'prompt' => Yii::t('backend','All')
                                    ]
                                ),
            ],
        ]

    ]);
    // Create submit button
    sdf
?>