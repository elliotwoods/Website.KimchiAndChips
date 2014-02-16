<?
$sections = array("news", "about", "works", "contact", "blog");
?>
            <div id="navigationBar">
                <img class="title" src="images/common/logo.jpg" width="204" height="48"/>
<?
foreach($sections as $section) {
    ?>
                <a href="<?= $section . "." . ($isLive ? "html" : "php") ?>">
                    <div class="navigationItem">
                        <?= ucwords($section) ?>
                    </div>
                </a>
    <?
}
?>
            </div>