<?php
namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;

use common\models\Gallery as GalleryModel;

class Gallery extends Widget{
    public $slug = '';
    public $ulClass = null;
    public $liClass = null;
    public $imgClass = null;
    public $gallery = null;

    public function init(){
        $this->gallery = GalleryModel::findOne(['slug' => $this->slug]);
        parent::init();
    }

    public function run(){
        $htmlGallery = '';
        if (isset($this->gallery)) {
            $galleryImages = $this->gallery->getGalleryImages()
                                ->where(['is_active' => true])
                                ->orderBy(['sort_order' => SORT_ASC])
                                ->all();
            if (count($galleryImages)>1) {
                $htmlGallery = $this->generateHtmlForMultipleImages($galleryImages);
            }
            else{
                $htmlGallery = $this->generateHtmlForSingleImage($galleryImages[0]);
            }
        }
        return $htmlGallery;
    }

    private function generateHtmlForMultipleImages($galleryImages){
        return Html::ul($galleryImages, [
                'class' => $this->ulClass,
                'item' => function($galleryImage, $index){
                    return Html::tag('li',
                                    Html::img($galleryImage->url, ['class'=>$this->imgClass]),
                                ['class' => $this->liClass]);
                }
            ]);
    }

    private function generateHtmlForSingleImage($galleryImage){
        return Html::img($galleryImage->url, ['class'=>$this->imgClass]);
    }
}