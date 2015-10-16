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
                'attribute' => 'category',
                'filter' => Html::activeDropDownList($sourceMessageSearch, 'category',
                                    SourceMessage::getAllCategoriesAsArray(),
                                    [
                                        'class'=>'form-control',
                                        'prompt' => Yii::t('backend','All')
                                    ]
                                ),
            ],
            'message',
            [
                'label' => Yii::t('backend', 'Message Translations'),
                'value' => function($model){
                        $translatedMessages = $model->translatedMessages;
                    return 'hole';
                }
            ]
        ]

    ]);?>