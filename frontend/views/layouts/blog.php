<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;

use common\models\BlogCategory;

$this->registerLinkTag([
    'rel'=>'alternate',
    'type'=>'application/rss+xml',
    'title'=>Yii::$app->name,
    'href'=>Url::to(['blog/feed'], true),
]);

?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="row">
  <div class="col-sm-8">
    <div class="blog-content">
      <?= $content ?>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="blog-sidebar">
      <h3><?= Yii::t('blog', 'Categories') ?></h3>
      <?php $categories=BlogCategory::find()->all(); ?>
      <ul>
        <?php foreach ($categories as $category): ?><li><?= Html::a($category->name, $category->url) ?></li><?php endforeach; ?>
      </ul>
      <h3><?= Yii::t('blog', 'Tags') ?></h3>
      <p>
        <?php 
        $list=[];
        foreach ($this->context->getAllTags() as $tag) {
          $list[]=Html::a($tag, ['blog/index','tag'=>$tag]);
        }
        echo implode(", ", $list);
        ?>
      </p>
    </div>
  </div>
</div>

<?php $this->endContent(); ?>