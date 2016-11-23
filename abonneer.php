<?php

// Script om abonnement te nemen:  http://www.swiftdev.nl/abonneer.php (met in POST: email=motoom@xs4all.nl

// TODO: ReCAPTCHA gebruiken.

date_default_timezone_set("Europe/Amsterdam");

function userip()
{
	if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
		$ip = $_SERVER["HTTP_CLIENT_IP"];
		}
	elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
		$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		}
	else {
		$ip = $_SERVER["REMOTE_ADDR"];
		}
	return $ip;
	}

function randomkey() {
	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	$key = "";
	for ($i = 0; $i < 16; $i++) {
		$key .= $chars[mt_rand(0, strlen($chars)-1)];
		}
	return $key;
	}

// Haal abonnees, indien die aanwezig zijn.
$jsonfilename = "state/abonnees.json";
$abonnees = array();
if (file_exists($jsonfilename)) {
	$abonnees = json_decode(file_get_contents($jsonfilename));
	}

$email = strtolower($_POST["email"]);

// Niet dubbel abonneren
$reedsgeabonneerd = FALSE;
foreach($abonnees as $abonnee) {
	if ($abonnee->email == $email) {
		$reedsgeabonneerd = TRUE;
		break;
		}
	}

if ($reedsgeabonneerd) {
	$content = "<h1>Bedankt</h1><p>Je was al geabonneerd.</p>";
	}
else {
	$abonnee = new stdClass();
	$abonnee->ip = userip();
	$abonnee->unsubscribekey = randomkey();
	$abonnee->email = $email;
	$abonnee->subscribedate = date("Y-m-d");

	$abonnees[] = $abonnee;
	
	if (file_put_contents($jsonfilename, $json = json_encode($abonnees, JSON_PRETTY_PRINT)) === FALSE) {
		die("Configuratiefout: het script heeft geen schrijftoegang tot de schijf. Neem contact op met de programmeur.");
		}
	$content = "<h1>Bedankt</h1><p>Dankjewel voor het abonneren.</p>";
	}

// Gebruik de artikel template voor een bevestigingspagina.
$metatitle = $metadescription = $metakeywords = $metaauthor = $contenttitle = "";
include("templates/artikel.php");
