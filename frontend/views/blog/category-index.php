<?php
use yii\helpers\Html;

$this->title = $blogCategory->name;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $blogCategory->meta_description
]);

?>

<?= $this->render('_posts', ['blogPostProvider'=> $blogPostProvider] ); ?>
