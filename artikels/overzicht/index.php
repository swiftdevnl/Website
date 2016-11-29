<?php

date_default_timezone_set("Europe/Amsterdam");

$directory = "..";

// Subdirectories of the articles
$articledirnames = array();
if ($dh = opendir($directory)) {
	while($file = readdir($dh)) {
	    if (!is_dir($directory."/".$file))
			continue;
		$articledirnames[] = $file;
		}
	closedir($dh);
	}

$articles = array(); // Mapping from articledirname -> properties of the article		
foreach($articledirnames as $articledirname) {
	if ($articledirname[0] == ".") continue; // Onzichtbare subdirectories, en de subdirectories "." en ".." overslaan.
	
	$contentfn = "../".$articledirname."/content.html";

	$content = file_get_contents($contentfn);
	$lines = explode("\n", $content);

	// Haal er de meta-data uit.
	$contenttitle = $metadescription = $metakeywords = $metaauthor = $publishdate = "";

	foreach ($lines as $line) {
		$line = trim($line);
		if (substr($line, 0, 17) == "meta-description:") {
			$metadescription = trim(substr($line, 18));
			continue;
			}
		else if (substr($line, 0, 12) == "meta-author:") {
			$metaauthor = trim(substr($line, 13));
			continue;
			}
		else if (substr($line, 0, 14) == "content-title:") {
			$contenttitle = trim(substr($line, 15));
			continue;
			}
		else if (substr($line, 0, 13) == "publish-date:") {
			$publishdate = trim(substr($line, 14));
			continue;
			}
		else if (substr($line, 0, 4) == "-->")
			break;
		}
	
	if ($publishdate == "")
		continue; // Artikelen zonder publishdate niet tonen op dit overzicht.
	
	$articles[$articledirname] = (object)array(
									"dirname"=>$articledirname,
									"metadescription"=>$metadescription,
									"metaauthor"=>$metaauthor,
									"contenttitle"=>$contenttitle,
									"publishdate"=>$publishdate,
									);
	}

// Wegfilteren wat in de toekomst gepubliceerd moet worden.
$horizon = date("Y-m-d");

function pubdatefilter($a) {
	global $horizon;
	return $a->publishdate <= $horizon;
	}
	
$articles = array_filter($articles, "pubdatefilter");

// Sorteer op dalende publicatiedatum
function pubdatecmp($a, $b) {
	return strcmp($b->publishdate, $a->publishdate);
	}

usort($articles, "pubdatecmp");

$content = "<h1>Artikeloverzicht</h1>";
foreach ($articles as $article) {
	$content .= "<div class=\"artikel\"><h2><a href=\"../$article->dirname\">$article->contenttitle</a></h2><p class=\"datum\">$article->publishdate, door $article->metaauthor</p><p class=\"ankeiler\">$article->metadescription</p></div>";
	}

$metatitle = "Artikeloverzicht";
$metadescription = "Overzicht van alle artikelen op SwiftDev.nl";
$metakeywords = "artikels,swift";
$metaauthor = "";
$contenttitle = "Artikeloverzicht";
include("../../templates/artikel.php");


