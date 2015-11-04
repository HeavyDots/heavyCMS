<li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <?= $selectedLanguage['name'] ?>
    </a>
    <ul class="dropdown-menu">
        <li class="header"><?= Yii::t('widget', 'Select Language')?></li>
        <li>
            <ul class="menu">
                <?php foreach ($supportedLanguages as $language): ?>
                <li>
                    <a href="<?= $language['url'] ?>">
                        <?= $language['name'] ?>
                    </a>
                </li>
                <?php endforeach ?>
            </ul>
        </li>
    </ul>
</li>