<?php
require_once("config.php");
date_default_timezone_set("Europe/Amsterdam");

// Script om abonnement op te zeggen, met een URL als:
//    http://www.swiftdev.nl/opzeggen.php?email=example@site.com&code=GHS2xTY8

// Haal abonnees.
$jsonfilename = "state/abonnees.json";
$abonnees = array();
if (file_exists($jsonfilename)) {
	$abonnees = json_decode(file_get_contents($jsonfilename));
	}

// Email (en bevestigingscode) van het op te zeggen abonnement.
$email = strtolower($_GET["email"]);
$code = $_GET["code"];

// Verwijder hem uit de array van abonnees. 
$gevonden = FALSE;
$nr = 0;
foreach($abonnees as $abonnee) {
	if ($abonnee->email == $email && $abonnee->unsubscribekey == $code) {
		unset($abonnees[$nr]); // LET OP: bij het verwijderen van een element ergens middenin wordt $abonnees van eek key-loze array omgevormd naar een standaard object met numerieke keys. Zie ook http://stackoverflow.com/questions/5943149/rebase-array-keys-after-unsetting-elements
		$abonnees = array_values($abonnees);
		$gevonden = TRUE;
		break;
		}
	$nr++;
	}

// Laat het resultaat zien.
if ($gevonden) {
	$content = "<h1>Gelukt</h1><p>Je abonnement is opgezegd.</p>";
	if (file_put_contents($jsonfilename, $json = json_encode($abonnees, JSON_PRETTY_PRINT)) === FALSE) {
		die("Configuratiefout: het script heeft geen schrijftoegang tot de schijf. Neem contact op met de programmeur.");
		}
	$log = date("Y-m-d H:i:s")." ".$abonnee->ip." opzegging ".$abonnee->email;
 	@file_put_contents("state/abonnees.log", $log.PHP_EOL, FILE_APPEND|LOCK_EX);
	@mail($administrator_email, "SwiftDev.nl opzegging", $log, "From: admin@swiftdev.nl");
	}
else {
	$content = "<h1>Mislukt</h1><p>Ofwel je was niet geabonneerd, of je opzegcode klopt niet. Neem contact op als je denkt dat dit onterecht is.</p>";
	}

// Gebruik de artikel template voor een bevestigingspagina.
$metatitle = $metadescription = $metakeywords = $metaauthor = $contenttitle = "";
include("templates/artikel.php");
