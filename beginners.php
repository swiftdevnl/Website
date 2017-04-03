
<?php
require_once("config.php");
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

$email = strtolower($_POST["email"]);
$ip = userip();
$log = date("Y-m-d H:i:s")." ".$ip." wil video's beginnerscursus: ".$email;

@file_put_contents("state/beginners.log", $log.PHP_EOL, FILE_APPEND|LOCK_EX);
@mail("motoom@xs4all.nl", "SwiftDev.nl beginnerscursus aanmelding van: $email", $log, "From: admin@swiftdev.nl");

// Gebruik de artikel template voor een bevestigingspagina.
$content = "<h1>Bedankt</h1><p>Dankjewel voor je interesse. We sturen je binnenkort een email.</p>";
$metatitle = $metadescription = $metakeywords = $metaauthor = $contenttitle = "";
include("templates/artikel.php");
