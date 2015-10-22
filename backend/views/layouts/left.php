<?php
use yii\helpers\Html;
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?= Html::img(Yii::$app->user->identity->userProfile->getFullUrlAvatar(),
                                ['class'=> 'img-circle',
                                 'alt' => Yii::$app->user->identity->fullName]) ?>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->fullName ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => Yii::t('theme/menu', 'Menu'), 'options' => ['class' => 'header']],
                    [
                        'label' => Yii::t('theme/menu', 'Pages'),
                        'icon' => 'fa fa-files-o fa-lg',
                        'url' => ['flat-page/index']
                    ],
                    [
                        'label' => Yii::t('theme/menu', 'Content'),
                        'icon' => 'fa fa-indent fa-lg',
                        'url' => ['content/index']
                    ],
                    [
                        'label' => Yii::t('theme/menu', 'Translate Frontend'),
                        'icon' => 'fa fa-language fa-lg',
                        'url' => ['site/translate-frontend']
                    ],
                    [
                        'label' => Yii::t('theme/menu', 'Image Galleries'),
                        'icon' => 'fa fa-ellipsis-h fa-lg',
                        'url' => ['gallery/index']
                    ],
                    [
                        'label' => Yii::t('theme/menu', 'Blog'),
                        'icon' => 'fa fa-book fa-lg',
                        'url' => ['site/blog']
                    ],
                    [
                        'label' => Yii::t('theme/menu', 'Global Configuration'),
                        'icon' => 'fa fa-globe fa-lg',
                        'url' => ['global-configuration/index']
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
