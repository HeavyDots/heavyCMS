<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use common\models\base\GalleryImage as BaseGalleryImage;

/**
 * This is the model class for table "gallery_image".
 */
class GalleryImage extends BaseGalleryImage
{
    protected $uploadDirectory = 'galleries/';
    protected $uploadFullDirectory;
    protected $uploadURL;

    public function init(){
        $this->uploadFullDirectory = Yii::$app->params['frontendUploadDirectory'] . $this->uploadDirectory;
        $this->uploadURL = sprintf('%s%s%s',
                                    Yii::$app->params['frontendURL'],
                                    Yii::$app->params['uploadDirectoryForURL'],
                                    $this->uploadDirectory);
    }

    public function getFileFullPath(){
        return $this->uploadFullDirectory . $this->file_name;
    }

    public function getURL(){
        return $this->uploadURL . $this->file_name;
    }
}
