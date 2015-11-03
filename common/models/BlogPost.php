<?php
/*TODO: Make better organization of blog post image folders */
/*TODO: Generalize upload of one image to a Trait, to use it on: User Profile (avatar) and BlogPost (featured_image) */
/*TODO: Allow creation of subdirectories when uploading an image */
namespace common\models;

use Yii;
use common\models\base\BlogPost as BaseBlogPost;
use common\models\traits\Translation;

/**
 * This is the model class for table "blog_post".
 */
class BlogPost extends BaseBlogPost
{
    use Translation;

    protected $featuredImageDirectory = 'blog-post/';
    protected $featuredImageFullDirectory;
    protected $featuredImageURL;
    protected $defaultFeaturedImage;
    public $uploadedFeaturedImage;

    public function init(){
        $this->featuredImageFullDirectory = Yii::$app->params['frontendUploadDirectory'] . $this->featuredImageDirectory;
        $this->featuredImageURL = sprintf('%s%s%s',
                            Yii::$app->params['frontendURL'],
                            Yii::$app->params['uploadDirectoryForURL'],
                            $this->featuredImageDirectory);
        $this->defaultFeaturedImage = 'default_featured_image.jpg';
    }

    public function attributeLabels(){
        $parentAttributeLabels = parent::attributeLabels();
        $parentAttributeLabels['uploadedFeaturedImage'] = Yii::t('model', 'Featured Image');
        return $parentAttributeLabels;
    }

    public function getFullUrlFeaturedImage(){
        $featuredImage = isset($this->featured_image) ? $this->featured_image : $this->defaultFeaturedImage;
        return $this->featuredImageURL . $featuredImage;
    }

    public function saveFeaturedImageToDisk(){
        $uploadedOK = true;
        if (isset($this->uploadedFeaturedImage)) {
            $fileName = sprintf('%d-featured-%s.%s',
                    $this->id,
                    $this->uploadedFeaturedImage->baseName,
                    $this->uploadedFeaturedImage->extension);
            $fileFullPath = $this->featuredImageFullDirectory . $fileName;
            $this->uploadedFeaturedImage->saveAs($fileFullPath);

            /*TODO: Make better control over upload errors */
            if ($this->uploadedFeaturedImage->error==0) {
                $this->featured_image = $fileName;
                $this->save();
                $uploadedOK = true;
            }
            else{
                $uploadedOK = false;
            }
        }

        return $uploadedOK;
    }

    public function saveImageToDisk($image){
        $fileName = sprintf('%d-featured-%s.%s',
            $this->id,
            $image->baseName,
            $image->extension);
        $fileFullPath = $this->featuredImageFullDirectory . $fileName;
        $image->saveAs($fileFullPath);

        return $this->featuredImageURL . $fileName;
    }

}
