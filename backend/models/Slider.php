<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use \common\models\Slider as CommonSlider;
use \common\models\SliderImage;

/**
 * This is the model class for table "slider".
 */
class Slider extends CommonSlider
{

    public $uploadedImages;

    public function rules(){
        $parentRules = parent::rules();
        $parentRules[] = [['uploadedImages'], 'file', 'skipOnEmpty' => true, 'maxFiles' => 30];
        return $parentRules;
    }

    public function attributeLabels(){
        $parentAttributeLabels = parent::attributeLabels();
        $parentAttributeLabels['uploadedImages'] = Yii::t('backend', 'Upload Images');
        return $parentAttributeLabels;
    }

    /*TODO: Refactor saveImagesOnDisk, now is saving images on disk and creating new SliderImage objects*/
    public function saveImagesOnDisk(){
        $isValid = false;

        if ($this->validate()) {
            foreach ($this->uploadedImages as $key => $file) {
                $sliderImage = new SliderImage;
                $fileName = sprintf('%d-%s.%s',
                                        $this->id,
                                        $file->baseName,
                                        $file->extension);

                $sliderImage->slider_id = $this->id;
                $sliderImage->file_name = $fileName;
                $sliderImage->sort_order = $key;
                $sliderImage->is_active = true;
                $sliderImage->save();

                $file->saveAs($sliderImage->fileFullPath);
            }
            $isValid = true;
        }

        return $isValid;
    }

    public function getSliderImagesForSortableWidget(){
        $sliderImagesArray = [];
        $sliderImages = $this->getSliderImages()
                            ->orderBy(['id' => SORT_ASC])
                            ->all();
        foreach ($sliderImages as $sliderImage) {
            $sliderImagesArray[$sliderImage->id] = [
                    'content' => "<img src='{$sliderImage->url}' />",
                    'disabled' => !$sliderImage->is_active];
        }
        return $sliderImagesArray;
    }

    public function getOrderOfSliderImagesForSortableWidget(){
        $sliderImages = $this->getSliderImages()
                            ->select('id')
                            ->orderBy(['sort_order' => SORT_ASC])
                            ->all();
        $sliderImageIds = ArrayHelper::getColumn($sliderImages, 'id');
        $sliderImageIdsAsString = implode(',', $sliderImageIds);

        return $sliderImageIdsAsString;
    }

    public function reorderSliderImages($idsSorted){
        foreach ($idsSorted as $newPosition => $id) {
            $sliderImage = SliderImage::findOne($id);
            $sliderImage->sort_order = $newPosition;
            $sliderImage->save();
        }
    }
}
