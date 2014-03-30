<?
$sections = array("news", "about", "works", "contact", "blog");
?>
            <div id="topWhiteBlock"></div>
            <div id="navigationBar">
                <a href="http://kimchiandchips.com">
                    <img class="title" src="images/common/logo.jpg" width="204" height="48"/>
                </a>
<?
foreach($sections as $section) {
    if(strpos($_SERVER["SCRIPT_FILENAME"], $section) !== false) {
?>
                <div class="navigationItem navigationItemSelected">
                    <?= ucwords($section) ?>
                </div>
<?
    } else {
        $pageUrl = $section == "blog" ? "http://blog.kimchiandchips.com" : $section . "." . ($isLive ? "html" : "php");
        ?>
                <a href="<?= $pageUrl ?>">
                    <div class="navigationItem">
                        <?= ucwords($section) ?>
                    </div>
                </a>
        <?
    }
}
?>
            </div>
