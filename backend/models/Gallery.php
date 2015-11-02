<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use \common\models\Gallery as CommonGallery;
use \common\models\GalleryImage;

/**
 * This is the model class for table "Gallery".
 */
class Gallery extends CommonGallery
{

    public $uploadedImages;

    public function rules(){
        $parentRules = parent::rules();
        $parentRules[] = [['uploadedImages'], 'file', 'skipOnEmpty' => true, 'maxFiles' => 30];
        return $parentRules;
    }

    public function attributeLabels(){
        $parentAttributeLabels = parent::attributeLabels();
        $parentAttributeLabels['uploadedImages'] = Yii::t('app', 'Upload Images');
        return $parentAttributeLabels;
    }

    /*TODO: Refactor saveImagesOnDisk, now is saving images on disk and creating new GalleryImage objects*/
    public function saveImagesOnDisk(){
        $isValid = false;

        if ($this->validate()) {
            $imageNextPosition = $this->getImageNextPosition();
            foreach ($this->uploadedImages as $key => $file) {
                $galleryImage = new GalleryImage;
                $fileName = sprintf('%d-%s.%s',
                                        $this->id,
                                        $file->baseName,
                                        $file->extension);

                $galleryImage->gallery_id = $this->id;
                $galleryImage->file_name = $fileName;
                $galleryImage->sort_order = $imageNextPosition + $key;
                $galleryImage->is_active = true;
                $galleryImage->save();

                $file->saveAs($galleryImage->fileFullPath);
            }
            $isValid = true;
        }

        return $isValid;
    }

    public function getImageNextPosition(){
        $latestPosition = $this->getImageLatestPosition();
        $nextPosition = isset($latestPosition) ? $latestPosition + 1 : 0;

        return $nextPosition;
    }

    public function getImageLatestPosition(){
        $latestPositionGalleryImage = $this->getGalleryImages()
                            ->select('sort_order')
                            ->orderBy(['sort_order' => SORT_DESC])
                            ->one();
        $latestPosition = isset($latestPositionGalleryImage) ? $latestPositionGalleryImage->sort_order : null;
        return $latestPosition;
    }

    public function getGalleryImagesForSortableWidget(){
        $galleryImagesArray = [];
        $galleryImages = $this->getGalleryImages()
                            ->orderBy(['id' => SORT_ASC])
                            ->all();
        foreach ($galleryImages as $galleryImage) {
            $galleryImagesArray[$galleryImage->id] = [
                    'content' => Html::img($galleryImage->url),
                    'disabled' => !$galleryImage->is_active];
        }
        return $galleryImagesArray;
    }

    public function getOrderOfGalleryImagesForSortableWidget(){
        $galleryImages = $this->getGalleryImages()
                            ->select('id')
                            ->orderBy(['sort_order' => SORT_ASC])
                            ->all();
        $galleryImageIds = ArrayHelper::getColumn($galleryImages, 'id');
        $galleryImageIdsAsString = implode(',', $galleryImageIds);

        return $galleryImageIdsAsString;
    }

    public function reorderGalleryImages($idsSorted){
        if (count($idsSorted)>1) {
            foreach ($idsSorted as $newPosition => $id) {
                $galleryImage = GalleryImage::findOne($id);
                $galleryImage->sort_order = $newPosition;
                $galleryImage->save();
            }
        }
    }
}
