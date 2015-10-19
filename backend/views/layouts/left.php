<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => Yii::t('theme/menu', 'Menu'), 'options' => ['class' => 'header']],
                    [
                        'label' => Yii::t('theme/menu', 'Translate Frontend'),
                        'icon' => 'fa fa-language fa-lg',
                        'url' => ['site/translate-frontend']
                    ],
                    [
                        'label' => Yii::t('theme/menu', 'Manage Sliders'),
                        'icon' => 'fa fa-ellipsis-h fa-lg',
                        'url' => ['slider/index']
                    ],
                    [
                        'label' => Yii::t('theme/menu', 'Manage Blog'),
                        'icon' => 'fa fa-book fa-lg',
                        'url' => ['site/blog']
                    ],
                    [
                        'label' => Yii::t('theme/menu', 'Global Configuration'),
                        'icon' => 'fa fa-globe fa-lg',
                        'url' => ['site/global-configuration']
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
