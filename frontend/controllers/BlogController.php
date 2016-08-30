<?php
namespace frontend\controllers;

use Yii;

use yii\data\ActiveDataProvider;
use yii\web\HttpException;

use common\components\MultiLingualController;

use common\models\BlogPost;
use common\models\BlogCategory;
use common\models\FlatPage;

class BlogController extends MultiLingualController{
  
    public $layout='blog';

    public function actionIndex(){
        $flatPage = $this->findFlatPage('blog');
        $this->flatPage=$flatPage;

        $query = BlogPost::find()
                ->joinWith('translations')
                ->where(['is_published' => true])
                ->andWhere(['<>', 'blog_post_lang.slug', ''])
                ->andWhere(['blog_post_lang.language' => Yii::$app->language])
                ->orderBy(['created_at' => SORT_DESC]);

        $blogPostProvider = new ActiveDataProvider([
          'query' => $query,
            'pagination' => [
              'forcePageParam'=>false,
              'defaultPageSize'=>10,
            ],
        ]);

        return $this->render('index', compact('flatPage', 'blogPostProvider'));
    }

    public function actionView($slug){
        $post = $this->findBlogPost($slug);

        return $this->render('view', compact('post'));
    }

    public function actionCategoryIndex($slug){
        $blogCategory = $this->findBlogCategory($slug);

        $query = BlogPost::find()
                ->joinWith('translations')
                ->joinWith('blogCategory.translations')
                ->where(['is_published' => true])
                ->andWhere(['<>', 'blog_post_lang.slug', ''])
                ->andWhere(['blog_post_lang.language' => Yii::$app->language])
                ->andWhere(['blog_category_lang.slug' => $blogCategory->slug])
                ->orderBy(['created_at' => SORT_DESC]);

        $blogPostProvider = new ActiveDataProvider([
          'query' => $query,
            'pagination' => [
              'forcePageParam'=>false,
              'defaultPageSize'=>10,
            ],
        ]);

        return $this->render('category-index', compact('blogPostProvider', 'blogCategory'));
    }

    protected function findFlatPage($slug)
    {
        $flatPage = FlatPage::find()
                    ->where(['url'=>'blog'])
                    ->one();
        if (!isset($flatPage)) {
            throw new HttpException(404, Yii::t('app','The requested page does not exist.'));
        }

        return $flatPage;
    }

    protected function findBlogPost($slug)
    {
        $blogPost = BlogPost::findBySlug($slug);

        if (!isset($blogPost)) {
            throw new HttpException(404, Yii::t('app','The requested page does not exist.'));
        }

        return $blogPost;
    }

    protected function findBlogCategory($slug)
    {
        /*TODO: Clean Messy Code*/
        $blogCategoryCurrentLanguage = BlogCategory::find()
                    ->joinWith('translations')
                    ->where(['blog_category_lang.slug'=>$slug])
                    ->andWhere(['blog_category_lang.language'=>Yii::$app->language])
                    ->one();
        $blogCategory = $blogCategoryCurrentLanguage;
        /*Fallback language*/
        if (!isset($blogCategory)){
            $blogCategory = BlogCategory::find()
                    ->joinWith('translations')
                    ->where(['blog_category_lang.slug'=>$slug])
                    ->andWhere(['blog_category_lang.language'=>Yii::$app->params['fallbackLanguage']])
                    ->one();
            if (isset($blogCategory)&&$slug!=$blogCategory->slug) {
                $blogCategory = $blogCategoryCurrentLanguage;
            }
        }
        /*Main language*/
        if (!isset($blogCategory)){
            $blogCategory = BlogCategory::find()
                    ->joinWith('translations')
                    ->where(['blog_category_lang.slug'=>$slug])
                    ->andWhere(['blog_category_lang.language'=>Yii::$app->params['appMainLanguage']])
                    ->one();
            if (isset($blogCategory)&&$slug!=$blogCategory->slug) {
                $blogCategory = $blogCategoryCurrentLanguage;
            }
        }
        if (!isset($blogCategory)) {
            throw new HttpException(404, Yii::t('app','The requested page does not exist.'));
        }
        return $blogCategory;
    }


}