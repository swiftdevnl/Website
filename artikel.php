<?php
// Kijk vanuit welke directory we ge-included werden, en lees daar de artikel-tekst.
$includer = get_included_files()[0];
$contentfn = str_replace("/index.php", "/content.html", $includer);
// Sta alleen content uit .html files toe.
if (substr($contentfn, -5) != '.html') {
	header("Location: /");
	exit();
	}
$content = file_get_contents($contentfn);
$lines = explode("\n", $content);

// Haal er de meta-data uit.
$metatitle = $metadescription = $metakeywords = $metaauthor = "";

foreach ($lines as $line) {
	$line = trim($line);
	if (substr($line, 0, 11) == "meta-title:") {
		$metatitle = trim(substr($line, 12));
		continue;
		}
	else if (substr($line, 0, 17) == "meta-description:") {
		$metadescription = trim(substr($line, 18));
		continue;
		}
	else if (substr($line, 0, 14) == "meta-keywords:") {
		$metakeywords = trim(substr($line, 15));
		continue;
		}
	if (substr($line, 0, 12) == "meta-author:") {
		$metaauthor = trim(substr($line, 13));
		continue;
		}
	else if (substr($line, 0, 4) == "-->")
		break;
	}

// Gebruik al deze gegevens in de artikel template:
include("templates/artikel.php");
