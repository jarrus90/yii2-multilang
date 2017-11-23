<div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" id="lang-drop-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <span class="filter-option pull-left"><?= $current['code']; ?></span>
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="lang-drop-button">
        <?php foreach ($languages AS $lang) { ?>
            <li>
                <a href="<?= $lang['url']; ?>"><?= $lang['code']; ?></a>
            </li>
        <?php } ?>
    </ul>
</div>