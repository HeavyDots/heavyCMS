<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'HeavyCMS';
?>
<div class="site-index">
  <div class="body-content">
    <div class="row">
      <div class="jumbotron">
        <h1><?= Html::encode(Yii::t('app', 'Welcome to HeavyCMS')); ?></h1>
        <h2>(<?= Html::encode(Yii::t('app', 'easy, fast, flexible')); ?>)</h2>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?= Html::encode(Yii::t('app', 'Step 1')); ?></h3>
            <p><?= Html::encode(Yii::t('app', 'Add Pages')); ?></p>
          </div>
          <div class="icon">
            <i class="fa fa-files-o"></i>
          </div>
          <?= Html::a(Yii::t('app', 'Create your own Pages').' <i class="fa fa-arrow-circle-right"></i>',
                          $url = ['flat-page/index'],
                          ['class' => 'small-box-footer']);
          ?>
          </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?= Html::encode(Yii::t('app', 'Step 2')); ?></h3>
            <p><?= Html::encode(Yii::t('app', 'Add Content')); ?></p>
          </div>
          <div class="icon">
            <i class="fa fa-indent"></i>
          </div>
          <?= Html::a(Yii::t('app', 'Create great Content').' <i class="fa fa-arrow-circle-right"></i>',
                          $url = ['content/index'],
                          ['class' => 'small-box-footer']);
          ?>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?= Html::encode(Yii::t('app', 'Step 3')); ?></h3>
            <p><?= Html::encode(Yii::t('app', 'Add Images')); ?></p>
          </div>
          <div class="icon">
            <i class="fa fa-image"></i>
          </div>
          <?= Html::a(Yii::t('app', 'Upload awesome Images').' <i class="fa fa-arrow-circle-right"></i>',
                          $url = ['gallery/index'],
                          ['class' => 'small-box-footer']);
          ?>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?= Html::encode(Yii::t('app', 'Step 4')); ?></h3>
            <p><?= Html::encode(Yii::t('app', 'Add Blog Posts')); ?></p>
          </div>
          <div class="icon">
            <i class="fa fa-book"></i>
          </div>
          <?= Html::a(Yii::t('app', 'Write interesting Blog Posts').' <i class="fa fa-arrow-circle-right"></i>',
                          $url = ['blog-post/index'],
                          ['class' => 'small-box-footer']);
          ?>
        </div>
      </div>
    </div>

  </div>
</div>
