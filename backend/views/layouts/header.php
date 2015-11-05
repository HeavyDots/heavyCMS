<?php
use yii\helpers\Url;
use yii\helpers\Html;
use backend\widgets\LanguageDropdown;
/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">CMS</span><span class="logo-lg">' . Yii::$app->name . '</span>', Url::toRoute(['site/index']), ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <?= LanguageDropdown::widget(['activeClass' => 'active']) ?>

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?= Html::img(Yii::$app->user->identity->userProfile->getFullUrlAvatar(),
                                ['class'=> 'user-image',
                                 'alt' => Yii::$app->user->identity->fullName]) ?>
                        <span class="hidden-xs"><?= Yii::$app->user->identity->fullName ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?= Html::img(Yii::$app->user->identity->userProfile->getFullUrlAvatar(),
                                ['class'=> 'img-circle',
                                 'alt' => Yii::$app->user->identity->fullName]) ?>

                            <p>
                                <?= Yii::$app->user->identity->fullName ?>
                                <small><?= Html::encode(Yii::t('app', 'Great to see you again!')); ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?=
                                    Html::a(
                                        Yii::t('app', 'Profile'),
                                        ['site/user-profile'],
                                        ['class' => 'btn btn-default btn-flat']
                                        );
                                ?>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    Yii::t('app', 'Sign out'),
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
