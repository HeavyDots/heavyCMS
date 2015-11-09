<?php
use yii\helpers\Html;

$this->title = $flatPage->title;
?>

<div>
    <?php foreach ($posts as $post): ?>
        <article>
            <h1>
                <?= Html::a($post->title, $post->url, ['title' => $post->title]) ?>
            </h1>
            <?= Html::img($post->getFullUrlFeaturedImage(), ['alt' => $post->title])?>
            <p><?= $post->briefText ?></p>
        </article>
    <?php endforeach ?>
</div>