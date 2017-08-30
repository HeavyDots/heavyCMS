<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\HttpException;
use common\components\MultiLingualController;
use common\models\BlogPost;
use common\models\BlogCategory;
use common\models\FlatPage;

class BlogController extends MultiLingualController {

  public $layout = 'blog';

  public function actionIndex($tag = null) {
    $flatPage = $this->findFlatPage('blog');

    if (!empty($tag)) {
      $this->view->title = $tag;
    } else {
      $this->flatPage = $flatPage;
    }

    $query = BlogPost::find()
            ->joinWith('translations')
            ->where(['is_published' => true])
            ->andWhere(['<>', 'blog_post_lang.slug', ''])
            ->andWhere(['blog_post_lang.language' => Yii::$app->language])
            ->orderBy(['created_at' => SORT_DESC]);

    if (!empty($tag)) {
      $query->andFilterWhere(['like', 'tags_list', $tag]);
    }

    $blogPostProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => [
            'forcePageParam' => false,
            'defaultPageSize' => 10,
        ],
    ]);

    return $this->render('index', compact('flatPage', 'blogPostProvider'));
  }

  public function actionView($slug) {
    $post = $this->findBlogPost($slug);
    $this->view->params['blogPost'] = $post; // TODO: HeavyCMS

    return $this->render('view', compact('post'));
  }

  public function actionCategoryIndex($slug) {
    $blogCategory = $this->findBlogCategory($slug);
    $this->view->params['blogCategory'] = $blogCategory; // TODO: HeavyCMS

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
            'forcePageParam' => false,
            'defaultPageSize' => 10,
        ],
    ]);

    return $this->render('category-index', compact('blogPostProvider', 'blogCategory'));
  }

  protected function findFlatPage($slug) {
    $flatPage = FlatPage::find()
            ->where(['url' => 'blog'])
            ->one();
    if (!isset($flatPage)) {
      throw new HttpException(404, Yii::t('app', 'The requested page does not exist.'));
    }

    return $flatPage;
  }

  protected function findBlogPost($slug) {
    $blogPost = BlogPost::findBySlug($slug);

    if (!isset($blogPost)) {
      throw new HttpException(404, Yii::t('app', 'The requested page does not exist.'));
    }

    return $blogPost;
  }

  protected function findBlogCategory($slug) {
    /* TODO: Clean Messy Code */
    $blogCategoryCurrentLanguage = BlogCategory::find()
            ->joinWith('translations')
            ->where(['blog_category_lang.slug' => $slug])
            ->andWhere(['blog_category_lang.language' => Yii::$app->language])
            ->one();
    $blogCategory = $blogCategoryCurrentLanguage;
    /* Fallback language */
    if (!isset($blogCategory)) {
      $blogCategory = BlogCategory::find()
              ->joinWith('translations')
              ->where(['blog_category_lang.slug' => $slug])
              ->andWhere(['blog_category_lang.language' => Yii::$app->params['fallbackLanguage']])
              ->one();
      if (isset($blogCategory) && $slug != $blogCategory->slug) {
        $blogCategory = $blogCategoryCurrentLanguage;
      }
    }
    /* Main language */
    if (!isset($blogCategory)) {
      $blogCategory = BlogCategory::find()
              ->joinWith('translations')
              ->where(['blog_category_lang.slug' => $slug])
              ->andWhere(['blog_category_lang.language' => Yii::$app->params['appMainLanguage']])
              ->one();
      if (isset($blogCategory) && $slug != $blogCategory->slug) {
        $blogCategory = $blogCategoryCurrentLanguage;
      }
    }
    if (!isset($blogCategory)) {
      throw new HttpException(404, Yii::t('app', 'The requested page does not exist.'));
    }
    return $blogCategory;
  }

  private $allTags = null;

  /**
   * TODO: Only translate tags urls if tag is available for the specific language
   * @param integer $limit
   * @return array
   */
  public function getAllTags($limit = 20) {

    if ($this->allTags == null) {
      $allTags = array();

      $query = new \yii\db\Query;
      $query->select('tags_list')
              ->from('blog_post_lang')
              ->innerJoin('blog_post', 'blog_post.id=blog_post_lang.blog_post_id')
              ->where(['is_published' => true])
              ->andWhere(['<>', 'blog_post_lang.slug', ''])
              ->andWhere(['blog_post_lang.language' => Yii::$app->language]);
      $command = $query->createCommand();
      $posts = $command->queryAll();

      foreach ($posts as $post) {
        $tags_array = explode(",", $post['tags_list']);

        foreach ($tags_array as $tag) {
          $tag = trim($tag);
          if (!empty($tag)) {
            if (!isset($allTags[$tag])) {
              $allTags[$tag] = 1;
            } else {
              $allTags[$tag] = $allTags[$tag] + 1;
            }
          }
        }
      }

      arsort($allTags);

      $this->allTags = array_keys($allTags);

      $this->allTags = array_slice($this->allTags, 0, $limit);
    }

    return $this->allTags;
  }

}
