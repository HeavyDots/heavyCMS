<?php

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "slider_image".
 *
 * @property integer $slider_id
 * @property string $file_name
 * @property string $sort_order
 * @property integer $is_active
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \common\models\Slider $slider
 * @property \common\models\User $createdBy
 * @property \common\models\User $updatedBy
 */
class SliderImage extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slider_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slider_id', 'file_name'], 'required'],
            [['slider_id', 'sort_order', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['file_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'slider_id' => Yii::t('backend', 'Slider ID'),
            'file_name' => Yii::t('backend', 'File Name'),
            'sort_order' => Yii::t('backend', 'Sort Order'),
            'is_active' => Yii::t('backend', 'Is Active'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlider()
    {
        return $this->hasOne(\common\models\Slider::className(), ['id' => 'slider_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'updated_by']);
    }




}
