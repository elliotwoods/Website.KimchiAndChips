<?php
require("defaults.php");

$showWarnings = ! $isLive;
if(!$showWarnings) {
    error_reporting(E_ERROR | E_PARSE);
}

function loadProject($work) {
    $workStringURI = "./works/" . $work . "/main.json";
    $workString = file_get_contents($workStringURI);
    $workJson = json_decode($workString, true);

    return $workJson;
}

function buildValidWorks($works) {
?>
    <script type="text/javascript">
    var validWorks = [<?php
    $first = true;
    foreach($works as $work) {
        if (!$first) {
            print ', ';
        }
        $first = false;
        
        print '"' . $work . '"';
    }
    ?>];
    </script>
<?php
}

function buildHeadline($work) {
    $workJson = loadProject($work);
    $title = $workJson["title"];
    $format = $workJson["format"];
    $year = $workJson["year"];
    $city = $workJson["city"];
    $description = $workJson["description"];

    $notes = $format;
    if ($city || $year) {
        $notes .= "<br />";
        if ($city) {
            $notes .= " " . $city;
        }
        if ($year) {
            $notes .= " " . $year;
        }
    }

    $copy = "";
    $paragraphCount = 0;
    if ($description) {
        foreach ($description as $paragraph) {
            if ($paragraphCount++ > 2) {
                break;
            }
            $copy .= "                            <p>
                                " . $paragraph . "
                            </p>
            ";
        }
    }
?>
                <div class="headlineWorkBox">
                    <a id="<?= $work ?>"></a>
                    <a href="#<?= $work ?>">
                       <img id="headlineImage" src="works/<?= $work ?>/headline.jpg" />
                    </a>
                    <div class="workTextBlock" id="headlineTextBlock">
                        <a href="#<?= $work ?>">
                            <div class="workHeader">
                                    <span class="workTitle"><?= $title ?></span>
                                    <br />
                                    <span class="workNotes">
                                        <?= $notes ?>
                                    </span>
                            </div>
                        </a>
                        <div class="workCopy">
                            <?= $copy ?>
                        </div>
                    </div>
                </div>
<?
}

function buildSubHeadline($work) {
    $workJson = loadProject($work);
    $title = $workJson["title"];
    $format = $workJson["format"];
    $year = $workJson["year"];
    $city = $workJson["city"];
    $description = $workJson["description"];

    $notes = $format;
    if ($city || $year) {
        $notes .= "<br />";
        if ($city) {
            $notes .= " " . $city;
        }
        if ($year) {
            $notes .= " " . $year;
        }
    }

    $copy = "";
    if ($description) {
        foreach ($description as $paragraph) {
            $copy .= "                            <p>
                                " . $paragraph . "
                            </p>
            ";
        }
    }
?>
                <div class="subHeadlineWorkBox">
                    <a id="<?= $work ?>"></a>
                    <a href="#<?= $work ?>">
                        <img class="subHeadlineImage" src="works/<?= $work ?>/subHeadline.jpg" />
                        <div class="workTextBlock">
                            <a href="#<?= $work ?>">
                                <div class="workHeader">
                                        <span class="workTitle"><?= $title ?></span>
                                        <br />
                                        <span class="workNotes">
                                            <?= $notes ?>
                                        </span>
                                </div>
                            </a>
                            <div class="workCopy">
                                <?= $copy ?>
                            </div>
                        </div>
                    </a>
                </div>
<?
}

function buildOtherWorks($works) {
    foreach ($works as $work) {
        try
        {
            buildOtherWork($work);    
        }
        catch (Exception $exception)
        {
        }
    }
}

function buildOtherWork($work) {
    $workJson = loadProject($work);
    $title = $workJson["title"];
    $format = $workJson["format"];
    $year = $workJson["year"];
    $city = $workJson["city"];
    $description = $workJson["description"];

    $notes = $format;
    if ($city || $year) {
        $notes .= "<br />";
        if ($city) {
            $notes .= " " . $city;
        }
        if ($year) {
            $notes .= " " . $year;
        }
    }

    $summary = $workJson["summary"];
?>
                <div class="workBox">
                    <a id="<?= $work ?>"></a>
                    <a href="#<?= $work ?>">
                        <img src="works/<?= $work ?>/front.jpg" />
                    </a>
                    <div class="workTextBlock">
                        <a href="#<?= $work ?>">
                            <div class="workHeader">
                                    <span class="workTitle"><?= $title ?></span>
                                    <br />
                                    <span class="workNotes">
                                        <?= $notes ?>
                                    </span>
                            </div>
                        </a>
                        <div class="workCopy">
                            <p>
                                <?= $summary ?>
                            </p>
                        </div>
                    </div>
                </div>
<?
}

function stripWorks(&$works, $work) {
    $key = array_search($work, $works);
    if($key !== false) {
        unset($works[$key]);
    }
}

$worksString = file_get_contents("./works/main.json");
$worksJson = json_decode($worksString, true);

$works = $worksJson["works"];
$headlineSelection = $worksJson["headline"];
$subHeadlineSelection = $worksJson["subHeadline"];

function buildContent($works, $headlineSelection, $subHeadlineSelection) {
    buildHeadline($headlineSelection);
    buildSubHeadline($subHeadlineSelection);

    
    stripWorks($works, $headlineSelection);
    stripWorks($works, $subHeadlineSelection);

    buildOtherWorks($works);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">  
    <head>
<? require("header.php"); ?>
        <link rel="stylesheet" type="text/css" href="works.css">
        <? buildValidWorks($works); ?>
        <script type="text/javascript" src="works.js"></script>
    </head>  
    <body>
        <a href="#">
            <div id="dim">
                <a id="main"></a>&nbsp;
            </div>
        </a>
        <div id="top">
            <div id="workBoxTextBlock">
                some stuff goes here
            </div>
            <div id="workBoxImageBlock">
                image block
            </div>
        </div>
        <div id="main">

<? require("navigationBar.php"); ?>

            <div id="content">
<?php
buildContent($works, $headlineSelection, $subHeadlineSelection);
?>
            <div class="footer">
                KIMCHI and CHIPS
            </div>
        </div>
    </body>
</html>