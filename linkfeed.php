<?php

date_default_timezone_set("Europe/Amsterdam");

// Haal bestaande linkfeed, indien die aanwezig is.
$linkfeedfilename = "state/linkfeed.json";
$linkfeed = array();
if (file_exists($linkfeedfilename)) {
	$linkfeed = json_decode(file_get_contents($linkfeedfilename));
	}

// Sorteer op dalende publicatiedatum
function pubdatecmp($a, $b) {
	return strcmp($b->publicatiedatum, $a->publicatiedatum);
	}

usort($linkfeed, "pubdatecmp");

$content = "<h2>Link feed</h2><p>Interessante internationale artikelen en blogpostings, verzameld door Digitist.</p>";

foreach($linkfeed as $link) {
    $content.= "<p><span title=\"$link->publicatiedatum\">&bullet; $link->titel</a> <a href=\"$link->url\" target=\"_blank\">lees&hellip;</a></p>";
	}

$metatitle = "Link feed";
$metadescription = "Interessante internationale artikelen en blogpostings, verzameld door Digitist.";
$metakeywords = "link,blog,feed,swift,artikels";
$metaauthor = "Adri Mathlener";
$contenttitle = "Link feed";
include("templates/artikel.php");
