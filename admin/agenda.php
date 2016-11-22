<?php
require_once("../config.php");

$user = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];
$validated = ($user == $admin_agenda_username && $password == $admin_agenda_password);

if (!$validated) {
	header('WWW-Authenticate: Basic realm="Swiftdev.nl Agenda beheer"');
	header('HTTP/1.0 401 Unauthorized');
	die("Not authorized");
	}

// Haal bestaande settings
$agenda = (object)array("naam"=>"Jan", "age"=>25);

$agenda = new stdClass();
$agenda->zondagdatum = "";
$agenda->zondagpunt1 = "";
$agenda->zondagpunt2 = "";
$agenda->zondagpunt3 = "";
$agenda->maandagdatum = "";
$agenda->maandagpunt1 = "";
$agenda->maandagpunt2 = "";
$agenda->maandagpunt3 = "";
$agenda->submit = "";

// Haal bestaande agendapunten, indien die aanwezig zijn.
$jsonfilename = "../state/agenda.json";
if (file_exists($jsonfilename)) {
	$agenda = json_decode(file_get_contents($jsonfilename));
	$agenda->submit = "";
	}

// Als het een POST is, verwerk dan het form.
if (array_key_exists("submit",$_POST)) {
	$agenda = new stdClass();
	$agenda->zondagdatum = trim($_POST["zondagdatum"]);
	$agenda->zondagpunt1 = trim($_POST["zondagpunt1"]);
	$agenda->zondagpunt2 = trim($_POST["zondagpunt2"]);
	$agenda->zondagpunt3 = trim($_POST["zondagpunt3"]);
	$agenda->maandagdatum = trim($_POST["maandagdatum"]);
	$agenda->maandagpunt1 = trim($_POST["maandagpunt1"]);
	$agenda->maandagpunt2 = trim($_POST["maandagpunt2"]);
	$agenda->maandagpunt3 = trim($_POST["maandagpunt3"]);
	$agenda->submit = trim($_POST["submit"]);

	if (file_put_contents($jsonfilename, $json = json_encode($agenda, JSON_PRETTY_PRINT)) === FALSE) {
		die("Configuratiefout: het script heeft geen schrijftoegang tot de schijf. Neem contact op met de programmeur.");
		}
	else {
		// TODO: Eventueel redirecten naar successform of homepage.
		// Vooralsnog opnieuw de agenda pagina tonen, met een 'opgeslagen' melding:
		}
	}

// Presenteer form.
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>SwiftDev.nl - Agenda beheer</title>
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
    <div class="container">
        <div class="row">
            <h1><a href="/"><img src="../img/logo75.png" alt="SwiftDev.nl" /></a></h1>
			<h1>Agenda beheer</h1>
        </div>
        
        <div class="row">
			<form class="agenda" action="" method="post" accept-charset="utf-8">
				<h3>Zondagmiddag coding sessie</h3>
				<p>Datum <input name="zondagdatum" type="text" size="10" placeholder="20 nov" value="<?= $agenda->zondagdatum ?>"> (bijvoorbeeld: 20 nov)</p>
				<p>Punt 1 <input name="zondagpunt1" type="text" size="30" value="<?= $agenda->zondagpunt1 ?>"></p>
				<p>Punt 2 <input name="zondagpunt2" type="text" size="30" value="<?= $agenda->zondagpunt2 ?>"></p>
				<p>Punt 3 <input name="zondagpunt3" type="text" size="30" value="<?= $agenda->zondagpunt3 ?>"></p>

				<h3>Maandagavond hangout</h3>
				<p>Datum <input name="maandagdatum" type="text" size="10" placeholder="3 dec" value="<?= $agenda->maandagdatum ?>"></p>
				<p>Punt 1 <input name="maandagpunt1" type="text" size="30" value="<?= $agenda->maandagpunt1 ?>"></p>
				<p>Punt 2 <input name="maandagpunt2" type="text" size="30" value="<?= $agenda->maandagpunt2 ?>"></p>
				<p>Punt 3 <input name="maandagpunt3" type="text" size="30" value="<?= $agenda->maandagpunt3 ?>"></p>
				
				<p><input name="submit" type="Submit" value="  Bewaar  "></p>
				<?php if ($agenda->submit != "") echo("<p>Gegevens zijn opgeslagen. Naar <a href=\"/\">home</a> om resultaat te bekijken.</p>"); ?>
			</form>
		</div>
	</div>
</body>
</html>
