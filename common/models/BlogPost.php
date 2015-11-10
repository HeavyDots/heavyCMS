<?php
/*TODO: Make better organization of blog post image folders */
/*TODO: Generalize upload of one image to a Trait, to use it on: User Profile (avatar) and BlogPost (featured_image) */
/*TODO: Allow creation of subdirectories when uploading an image */
/*TODO: Add support for tags */
namespace common\models;

use Yii;
use yii\helpers\Url;
use yii\helpers\StringHelper;
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

    public static function findBySlug($slug, $language = null){
        $language = isset($language) ? $language : Yii::$app->language;
        return self::find()
                ->joinWith('translations')
                ->where(['blog_post_lang.slug'=>$slug])
                ->andWhere(['blog_post_lang.language'=>$language])
                ->one();
    }

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

    /*TODO: remove double slash i.e.: http://heavycms.dev//site/contact*/
    public function getFullUrl(){
        return Yii::$app->params['frontendURL'] . $this->getUrl();
    }

    public function getUrl(){
        return Url::toRoute(['blog/view', 'slug'=>$this->slug]);
    }

    public function getBriefText(){
        return StringHelper::truncateWords($this->text, 40);
    }
}
