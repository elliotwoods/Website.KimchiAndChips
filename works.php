<?php
require("defaults.php");
require("Parsedown.php");

//variables
$works = array(); // array of Work classes
$headlineSelection = "";
$subHeadlineSelection = "";
//
$showWarnings = ! $isLive;

class Work {
    public $shortTitle;

	public $title;
	public $summary;
    public $format;
    public $year;
    public $city;
    public $description = "";
    public $brief = "";

    public function load($shortTitle) {
		$Parsedown = new Parsedown();

        $this->shortTitle = $shortTitle;

	    $folder = "./works/" . $shortTitle . "/";

	    $jsonString = file_get_contents($folder . "main.json");
	    $json = json_decode($jsonString, true);

	    if(array_key_exists("title", $json)) {
	        $this->title = $json["title"];
	    }
		if(array_key_exists("summary", $json)) {
	        $this->summary = $json["summary"];
	    }
	    if(array_key_exists("format", $json)) {
	        $this->format = $json["format"];
	    }
	    if(array_key_exists("year", $json)) {
	        $this->year = $json["year"];
	    }
	    if(array_key_exists("city", $json)) {
	        $this->city = $json["city"];
	    }
	    if(array_key_exists("description", $json)) {
	        //old style description as array of paragraphs with html formatting
	        $paragraphCount = 0;
	        $this->description = "";
	        foreach ($json["description"] as $paragraph) {
	            $this->description .= "                            <p>
	                              " . $paragraph . "
	                          </p>
	                          ";
	        }
	    } else if(file_exists($folder . "description.md")){
	        //try and load markdown
	        $descriptionMarkdown = file_get_contents($folder . "description.md");
	        $this->description = $Parsedown->text($descriptionMarkdown);
	    }
	    if(array_key_exists("brief", $json)) {
	        $this->brief = "<p>" . $json["brief"] . "</p>";
	    } else if (file_exists($folder . "brief.md")) {
	        //try and load markdown
			$briefMarkdown = file_get_contents($folder . "brief.md");
			$this->brief = $Parsedown->text($briefMarkdown);
	    } else {
	        //use first paragraph of description

	        if(array_key_exists("description", $json)) {
	            //old format in json
	            //brief is just first paragraph
	            if(count($json["description"]) >= 1) {
	                $this->brief = "<p>" . $json["description"][0] . "</p>";
	            }
			} else {
				//try to pull first paragraph from formatted description
				$paragraphs = explode("</p>", $this->description);
				if(count($paragraphs) >= 1) {
					$this->brief = $paragraphs[0] + "</p>";
				} else {
					$this->brief = $this->description;
				}

				$this->brief = strip_tags($this->description);
			}
		}
	}
}

if(!$showWarnings) {
    error_reporting(E_ERROR | E_PARSE);
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

        print '"' . $work->shortTitle . '"';
    }
    ?>];
    </script>
<?php
}

function buildNotes($work) {
	$notes = "";
	if(isset($work->format)) {
		$nodes = $work->format;
	}
	if(isset($work->city) || isset($work->year)) {
		if(!empty($notes)) {
			$notes .= "<br />";
		}

		if (isset($work->city)) {
			$notes .= " " . $work->city;
		}
		if (isset($work->year)) {
			$notes .= " " . $work->year;
		}
	}
	return $notes;
}

function buildHeadline($work) {
	$notes = buildNotes($work);
?>
                <div class="headlineWorkBox">
                    <a id="<?= $work->shortTitle ?>"></a>
                    <a href="#<?= $work->shortTitle ?>">
                       <img id="headlineImage" src="works/<?= $work->shortTitle ?>/headline.jpg" />
                    </a>
                    <div class="workTextBlock" id="headlineTextBlock">
                        <a href="#<?= $work->shortTitle ?>">
                            <div class="workHeader">
                                    <span class="workTitle"><?= $work->title ?></span>
                                    <br />
                                    <span class="workNotes">
                                        <?= $notes ?>
                                    </span>
                            </div>
                        </a>
                        <div class="workCopy">
                            <?= $work->brief ?>
                        </div>
                    </div>
                </div>
<?
}

function buildSubHeadline($work) {
    $notes = buildNotes($work);
?>
                <div class="subHeadlineWorkBox">
                    <a id="<?= $work->shortTitle ?>"></a>
                    <a href="#<?= $work->shortTitle ?>">
                        <img class="subHeadlineImage" src="works/<?= $work->shortTitle ?>/subHeadline.jpg" />
                        <div class="workTextBlock" style="height:350px;">
                            <a href="#<?= $work->shortTitle ?>">
                                <div class="workHeader">
                                        <span class="workTitle"><?= $work->title ?></span>
                                        <br />
                                        <span class="workNotes">
                                            <?= $notes ?>
                                        </span>
                                </div>
                            </a>
                            <div class="workCopy">
                                <?= $work->brief ?>
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
	$notes = buildNotes($work);
?>
                <div class="workBox">
                    <a id="<?= $work->shortTitle ?>"></a>
                    <a href="#<?= $work->shortTitle ?>">
                        <img src="works/<?= $work->shortTitle ?>/front.jpg" />
                    </a>
                    <div class="workTextBlock">
                        <a href="#<?= $work->shortTitle ?>">
                            <div class="workHeader">
                                    <span class="workTitle"><?= $work->title ?></span>
                                    <br />
                                    <span class="workNotes">
                                        <?= $notes ?>
                                    </span>
                            </div>
                        </a>
                        <div class="workCopy">
                            <p>
                                <?= $work->summary ?>
                            </p>
                        </div>
                    </div>
                </div>
<?
}

function stripWorks($works, $work) {
	unset($works[$work]);
	return $works;
}

function buildContent($works, $headlineSelection, $subHeadlineSelection) {
    buildHeadline($works[$headlineSelection]);
    buildSubHeadline($works[$subHeadlineSelection]);

	$otherWorks = $works;
    $otherWorks = stripWorks($otherWorks, $headlineSelection);
    $otherWorks = stripWorks($otherWorks, $subHeadlineSelection);

    buildOtherWorks($otherWorks);
}

$mainJsonString = file_get_contents("./works/main.json");
$mainJson = json_decode($mainJsonString, true);

$workShortTitles = $mainJson["works"];

$works = array();
foreach($workShortTitles as $workShortTitle) {
    $works[$workShortTitle] = new Work();
    $works[$workShortTitle]->load($workShortTitle);
}

$headlineSelection = $mainJson["headline"];
$subHeadlineSelection = $mainJson["subHeadline"];

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
				<div id="workBoxDetailsBlock">

				</div>
				<div id="workBoxDescriptionBlock">

				</div>
            </div>

            <div id="workBoxImageBlock">

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
