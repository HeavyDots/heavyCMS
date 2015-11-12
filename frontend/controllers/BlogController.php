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

    public function actionIndex(){
        $flatPage = $this->findFlatPage('blog');

        $query = BlogPost::find()
                ->joinWith('translations')
                ->where(['is_published' => true])
                ->andWhere(['<>', 'blog_post_lang.slug', ''])
                ->andWhere(['blog_post_lang.language' => Yii::$app->language])
                ->orderBy(['created_at' => SORT_DESC]);

        $blogPostProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', compact('flatPage', 'blogPostProvider'));
    }

    public function actionView($slug){
        $blogPost = $this->findBlogPost($slug);

        return $this->render('view', compact('blogPost'));
    }

    public function actionCategoryIndex($slug){
        $flatPage = $this->findFlatPage('blog');
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
        ]);

        return $this->render('category-index', compact('flatPage', 'blogPostProvider'));
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
        $blogCategory = BlogCategory::find()
                    ->joinWith('translations')
                    ->where(['blog_category_lang.slug'=>$slug])
                    ->andWhere(['blog_category_lang.language'=>Yii::$app->language])
                    ->one();

        if (!isset($blogCategory)) {
            throw new HttpException(404, Yii::t('app','The requested page does not exist.'));
        }
        return $blogCategory;
    }


}