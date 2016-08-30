<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
$models=$blogPostProvider->getModels();
?>

<?php if ($models): ?>
<?php foreach ($models as $post): ?>
  <article class="blog-post-item">
    <h2 class="title"><?= Html::a($post->title, $post->url, ['title' => $post->title]) ?></h2>
    <p class="text-muted"><?= Yii::t('blog', 'Posted on {0,date,short}',$post->created_at)?></p>
    <?php if ($post->featured_image): ?>
      <p class="featured-image">
        <?= Html::img($post->getFullUrlFeaturedImage(), ['alt' => $post->title, 'class' => 'img-responsive'])?>
      </p>
    <?php endif; ?>
    <div class="excerpt">
      <?= $post->getBriefText() ?>
    </div>
  </article>
<?php endforeach ?>

<?php

echo LinkPager::widget([
    'pagination' => $blogPostProvider->pagination,
]);

?>
<?php else: ?>
  <p><?= Yii::t('blog', 'No posts found')?></p>
<?php endif; ?>
