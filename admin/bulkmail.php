<?php
require_once("../config.php");

$user = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];
$validated = ($user == $admin_bulkmail_username && $password == $admin_bulkmail_password);

if (!$validated) {
	header('WWW-Authenticate: Basic realm="Swiftdev.nl Bulkmail"');
	header('HTTP/1.0 401 Unauthorized');
	die("Not authorized");
	}

// Haal abonnees, indien die aanwezig zijn.
$jsonfilename = "../state/abonnees.json";
$abonnees = array();
if (file_exists($jsonfilename)) {
	$abonnees = json_decode(file_get_contents($jsonfilename));
	// [ip] => 93.73.134.68 [unsubscribekey] => nPUoOazByMyohqzS [email] => motoom@xs4all.nl [subscribedate] => 2016-11-16 ) [1] 
	}

// Als het een POST is, verwerk dan het form.
if (array_key_exists("submit",$_POST)) {
	// TODO: Beveiliging tegen dezelfde emailactie op dezelfde dag? Ivm. reload van gesubmitte page.
	if (empty($_POST["bulktype"])) die("Fout: Geen geadresseerden geselecteerd.");
	if (empty($_POST["onderwerp"])) die("Fout: Geen onderwerp ingevuld.");
	if (empty($_POST["berichttekst"])) die("Fout: Geen berichttekst ingevuld.");

	// Kijk welke adressen gemaild moeten worden.
	$bulktype = $_POST["bulktype"];
	if ($bulktype == "m") {
		$abonnees = array((object)array("email"=>"motoom@xs4all.nl", "unsubscribekey"=>"(unavailable)"));
		}
	elseif ($bulktype == "r") {
		$abonnees = array((object)array("email"=>"rudy.wouters1@telenet.be", "unsubscribekey"=>"(unavailable)"));
		}
	elseif ($bulktype == "mr") {
		$abonnees = array((object)array("email"=>"motoom@xs4all.nl", "unsubscribekey"=>"(unavailable)"),
					      (object)array("email"=>"rudy.wouters1@telenet.be", "unsubscribekey"=>"(unavailable)")
					     );
		}
	elseif ($bulktype == "mu") {
		$abonnees = array((object)array("email"=>"motoom@xs4all.nl", "unsubscribekey"=>"(unavailable)"),
		                  (object)array("email"=>"unknown9001@xs4all.nl", "unsubscribekey"=>"(unavailable)")
						 );
		}
	elseif ($bulktype == "mru") {
		$abonnees = array((object)array("email"=>"motoom@xs4all.nl", "unsubscribekey"=>"(unavailable)"),
		                  (object)array("email"=>"unknown9001@xs4all.nl", "unsubscribekey"=>"(unavailable)"),
		                  (object)array("email"=>"rudy.wouters1@telenet.be", "unsubscribekey"=>"(unavailable)")
						 );
		}
	elseif ($bulktype == "a") {		
		}
	else {
		die("Fout: Ongeldige geadressseerden keuze");
		}
	
	// Verstuur emails.
	$onderwerp = $_POST["onderwerp"];
	$total = count($abonnees);
	$nr = 1;
	foreach($abonnees as $abonnee) {
		$berichttekst = $_POST["berichttekst"];
		$berichttekst .= "\r\n\r\nWil je dit soort email niet meer ontvangen? Schrijf je dan uit door http://swiftdev.nl/opzeggen.php?email=$abonnee->email&code=$abonnee->unsubscribekey te bezoeken.\r\n";
		$berichttekst = wordwrap($berichttekst, 70, "\r\n");
		
		$res = mail($abonnee->email, $onderwerp, $berichttekst, "From: admin@swiftdev.nl");

		if ($res) 
			echo "$nr/$total $abonnee->email OK<br>";
		else
			echo "$nr/$total $abonnee->email ERROR<br>";

		$nr++;
		ob_flush();
		usleep(250); // Aantal milliseconden wachten, niet te snel versturen naar de mailserver.
		}
	echo "Versturen kompleet<br>";
	ob_flush();
	die("Einde script. Sluit het venster, of ga terug naar <a href=\"/\">homepage</a>.</p>");
	}

// Presenteer form.
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>SwiftDev.nl - Bulkmail</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/swiftdev.css">
	<link rel="shortcut icon" href="../img/favicon.png">    
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style> 
    </style>    
</head>
<body>
    <div class="top container-fluid">
    	<div class="container">
	        <div class="row">
	            <h1><a href="/"><img src="../img/logo75.png" alt="SwiftDev logo" /></a></h1>
	        </div>
		</div>
	</div>

    <div class="container">
        <div class="row">
			<h1>Bulkmail</h1>
        </div>
        
        <div class="row">
			<p><strong>Opgelet!</strong></p>
			<p>&bullet; Deze bulkmail-verstuur functie ondersteunt alleen platte tekst, dus geen opgemaakte tekst met HTML.</p>
			<p>&bullet; Maak je tekst eerst in orde in een tekstverwerker, en copy/paste de tekst hieronder in,
			want na het drukken op de 'Verzend' knop wordt de inhoud van het formulier gewist.</p>
			
			<form class="agenda" action="" method="post" accept-charset="utf-8">
				<h3>Geadresseerden</h3>
				<p>
					<input type="radio" name="bulktype" value="m"> motoom@xs4all.nl (test)<br>
					<input type="radio" name="bulktype" value="r"> rudy.wouters1@telenet.be (test)<br>
					<input type="radio" name="bulktype" value="mr"> motoom@xs4all.nl, rudy.wouters1@telenet.be (test)<br>
					<input type="radio" name="bulktype" value="mu"> motoom@xs4all.nl, unknown9001@xs4all.nl (test)<br>
					<input type="radio" name="bulktype" value="mru"> motoom@xs4all.nl, unknown9001@xs4all.nl, rudy.wouters1@telenet.be (test)<br>
					<input type="radio" name="bulktype" value="a"> <b>alle abonnees</b> (<?= count($abonnees) ?> personen)<br>
				</p>

				<h3>Bericht</h3>
				<p>onderwerp<br><input name="onderwerp" type="text" size="40"></p>
				<p>berichttekst<br><textarea name="berichttekst" style="width: 80%; height: 10em;"></textarea></p>
				
				<p><input name="submit" type="Submit" value="  Verzend  "></p>
			</form>
		</div>
	</div>
</body>
</html>
