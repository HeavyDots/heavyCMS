<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <?= $selectedLanguage['name'] ?>
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
        <?php foreach ($supportedLanguages as $language): ?>
        <li class="<?= $language['class']?>">
            <a href="<?= $language['url'] ?>">
                <?= $language['name'] ?>
            </a>
        </li>
        <?php endforeach ?>
    </ul>
</li>