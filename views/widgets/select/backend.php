<li class="treeview">
    <a href="#">
        <span><?= $current['name'] ?></span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <?php foreach ($languages AS $child) { ?>
            <li>
                <a href="<?= $child['url'] ?>">
                    <?= $child['name'] ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</li>