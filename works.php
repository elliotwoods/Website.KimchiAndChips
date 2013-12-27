<?php

$showWarnings = true;
if(!$showWarnings) {
    error_reporting(E_ERROR | E_PARSE);
}

function varDump($var) {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
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
        <meta charset="utf-8" />  
        <title>Kimchi and Chips</title>  
        <link rel="stylesheet" type="text/css" href="defaults.css">
        <link rel="stylesheet" type="text/css" href="works.css">
        <? buildValidWorks($works); ?>
        <script type="text/javascript" src="javascript/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="javascript/underscore-min.js"></script>
        <script type="text/javascript" src="essentials.js"></script>
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
            <div id="navigationBar">
                <img class="title" src="images/common/logo.jpg" width="204" height="48"/>
                <a href="news.html">
                    <div class="navigationItem">
                        News
                    </div>
                </a>
                <a href="about.html">
                    <div class="navigationItem">
                        About
                    </div>
                </a>
            
                <a href="works.html">
                    <div class="navigationItem">
                        Works
                    </div>
                </a>
            
                <a href="contact.html">
                    <div class="navigationItem">
                        Contact
                    </div>
                </a>
            
                <a href="blog/">
                    <div class="navigationItem">
                        Blog
                    </div>
                </a>
            </div>

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