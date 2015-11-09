<?php
namespace frontend\controllers;

use Yii;

use yii\web\HttpException;

use common\components\MultiLingualController;

use common\models\BlogPost;
use common\models\FlatPage;

class BlogController extends MultiLingualController{

    public function actionIndex(){
        $flatPage = $this->findFlatPage('blog');

        $posts = BlogPost::find()
                ->joinWith('translations')
                ->where(['is_published' => true])
                ->andWhere(['<>', 'blog_post_lang.slug', ''])
                ->andWhere(['blog_post_lang.language'=>Yii::$app->language])
                ->orderBy(['created_at' => SORT_DESC])
                ->all();

        return $this->render('index', compact('flatPage', 'posts'));
    }

    public function actionView($slug){
        $blogPost = $this->findBlogPost($slug);

        return $this->render('view', compact('blogPost'));
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


}