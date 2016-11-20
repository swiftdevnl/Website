<?php
// Kijk vanuit welke directory we ge-included werden, en lees daar de artikel-tekst.
$includer = get_included_files()[0];
$contentfn = str_replace("/index.php", "/content.html", $includer);
$content = file_get_contents($contentfn);
$lines = explode("\n", $content);

// Haal er de meta-data uit.
$metatitle = $metadescription = $metakeywords = "";

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
	else if (substr($line, 0, 4) == "-->")
		break;
	}

// Gebruik al deze gegevens in de artikel template:
include("templates/artikel.php");
