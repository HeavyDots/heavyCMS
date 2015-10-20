<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use common\models\base\SliderImage as BaseSliderImage;

/**
 * This is the model class for table "slider_image".
 */
class SliderImage extends BaseSliderImage
{
    protected $uploadDirectory = 'sliders/';
    protected $uploadFullDirectory;
    protected $uploadURL;

    public function init(){
        $this->uploadFullDirectory = Yii::$app->params['frontendUploadDirectory'] . $this->uploadDirectory;
        $this->uploadURL = sprintf('%s%s%s',
                                    Yii::$app->params['frontendURL'],
                                    Yii::$app->params['uploadDirectoryForURL'],
                                    $this->uploadDirectory);
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
            [
            'class' => BlameableBehavior::className(),
            ],
        ];
    }

    public function getFileFullPath(){
        return $this->uploadFullDirectory . $this->file_name;
    }

    public function getURL(){
        return $this->uploadURL . $this->file_name;
    }
}
