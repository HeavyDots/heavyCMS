<?php

/* @var $this \yii\web\View */
/* @var $content string */

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
      
      <h3><?= Yii::t('blog', 'Tags') ?></h3>
    </div>
  </div>
</div>

<?php $this->endContent(); ?>