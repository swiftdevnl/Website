<?php

date_default_timezone_set("Europe/Amsterdam");

// Haal bestaande agendapunten, indien die aanwezig zijn.
$agendafilename = "state/agenda.json";
$agenda = array();
if (file_exists($agendafilename)) {
	$agenda = json_decode(file_get_contents($agendafilename));
	}

// En de linkfeed.
$linkfeedfilename = "state/linkfeed.json";
$linkfeed = array();
if (file_exists($linkfeedfilename)) {
	$linkfeed = json_decode(file_get_contents($linkfeedfilename));
	}

// Wegfilteren wat in de toekomst gepubliceerd moet worden.
$horizon = date("Y-m-d");

function pubdatefilter($a) {
	global $horizon;
	return $a->publicatiedatum <= $horizon;
	}
	
$linkfeed = array_filter($linkfeed, "pubdatefilter");

// Sorteer op dalende publicatiedatum
function pubdatecmp($a, $b) {
	return strcmp($b->publicatiedatum, $a->publicatiedatum);
	}

usort($linkfeed, "pubdatecmp");

// Alleen de X meest recente entries.
$linkfeed = array_slice($linkfeed, 0, 5);


?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- De bovenstaande drie metatags moeten persé boven dit commentaar staan, andere tags hieronder -->
    <title>SwiftDev.nl - Nederlandstalige community van iOS ontwikkelaars</title>
    <meta name="keywords" content="iOS, apps, iPhone, iPad, Nederlandstalig, swift, programmeren, app maken, tutorial, handleiding, leren" />
    <meta name="description" content="SwiftDev.nl is een Nederlandstalige community van iOS ontwikkelaars die elkaar helpen met het maken van apps voor iPhone en iPad." />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/swiftdev.css">
	<link rel="shortcut icon" href="img/favicon.png">    
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<meta name="google-site-verification" content="-XNQ8HBmSTScbjIm63Pz0MZpdb--V3H3yhJ5q29Xg7g" owner="Aad" />
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	  ga('create', 'UA-76481042-2', 'auto');
	  ga('send', 'pageview');
	</script>    
</head>
<body>
    <div class="top container-fluid">
    	<div class="container">
	        <div class="row">
	            <h1><a href="/"><img src="img/logo75.png" alt="SwiftDev.nl" /></a></h1>
	        </div>
		</div>
	</div>
	
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="squeeze-left">
                    <h2>SwiftDev.nl</h2>
                    <p>...is een <em>online Nederlandstalige community</em> van personen die iOS apps willen maken, en dat samen doen is gezelliger!</p>
                    <p class="center breathe"><a target="_blank" class="btn btn-success" href="https://discord.gg/Z9KS9Ha">bezoek ons Discord chat-kanaal &rarr;</a></p>
                    <p>Online coding sessies via <a href="https://zoom.us/download#client_4meeting">zoom.us</a> worden in dit kanaal georganiseerd.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="squeeze-middle">
                    <h2>Online meetings</h2>
                    <ul class="unindented">
                    <li>Elke zondagavond live coding sessie</li>
                    <li>Tweewekelijks woensdagavond hangout</li>
                    <li><a href="artikels/videos">Bekijk videos</a> van vorige hangouts</li>
                    <li>Blijf op de hoogte via email:</li>
                    </ul>
                    <form class="subscribe" method="post" action="abonneer.php" accept-charset="utf-8">
                        <div class="input-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="je email adres" required>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"> abonneer </button>
                            </span>
                        </div><!-- /input-group -->
                    
                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <div class="squeeze-right">
                    <h2>Agenda</h2>
                    <p>Zondag <?php if (!empty($agenda->zondagdatum)) echo($agenda->zondagdatum); ?> 20:00, <a href="https://zoom.us/j/456434309" title="Live coding sessie">zoom &rarr;</a></p>
                    <ul class="indented">
						<?php if (!empty($agenda->zondagpunt1)) echo("<li>".$agenda->zondagpunt1."</li>"); ?>
						<?php if (!empty($agenda->zondagpunt2)) echo("<li>".$agenda->zondagpunt2."</li>"); ?>
						<?php if (!empty($agenda->zondagpunt3)) echo("<li>".$agenda->zondagpunt3."</li>"); ?>
                    </ul>
                    <p>Woensdag <?php if (!empty($agenda->woensdagdatum)) echo($agenda->woensdagdatum); ?> 20:00, <a href="https://zoom.us/j/245766538" title="Hangout">zoom &rarr;</a></p>
                    <ul class="indented">
 						<?php if (!empty($agenda->woensdagpunt1)) echo("<li>".$agenda->woensdagpunt1."</li>"); ?>
						<?php if (!empty($agenda->woensdagpunt2)) echo("<li>".$agenda->woensdagpunt2."</li>"); ?>
						<?php if (!empty($agenda->woensdagpunt3)) echo("<li>".$agenda->woensdagpunt3."</li>"); ?>
                    </ul>
                </div>
            </div>
        </div><!-- .row -->
        
        <div class="row gasp">
            <div class="col-md-4">
                <div class="squeeze-left">
                    <h2>Cursus voor beginners</h2>
					<p>Wij hebben een aantal videos speciaal geschikt voor beginnende app-programmeurs verzameld.
					Laat je mailadres achter en wij sturen je het materiaal.</p>
                    <form class="subscribe" method="post" action="beginners.php" accept-charset="utf-8">
                        <div class="input-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="je email adres" required>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"> ja! stuur me de videos </button>
                            </span>
                        </div><!-- /input-group -->                    
                    </form>
					<p>Bij problemen en vragen helpen wij je verder in een gezamelijke zoomsessie. Dit alles is geheel gratis!</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="squeeze-middle">
                    <h2>Apps van leden</h2>
                    <p>Een aantal leden hebben apps gemaakt die ondertussen in de AppStore staan.</p>
                    <p><a href="artikels/quotespin">Quote Spin</a> van Pieter Velghe</p>
                    <p><a href="artikels/logsave">LogSave</a> van Jan Pollaert</p>
                    <p><a href="artikels/horseranking">Horse Ranking</a> van Michel Kapelle</p>
					<hr>
					<h3>Divers</h3>
                    <p><a href="artikels/overzicht">Artikel overzicht&hellip;</a>
					<p><a href="/admin">Admin&hellip;</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="squeeze-right">
                    <h2>Link feed</h2>
                    <p>Interessante internationale artikelen en blogpostings, verzameld door leden.</p>
                    <ul class="unindented">
					    <?php
						foreach($linkfeed as $link) {
                            echo "<li>$link->titel <a date=\"$link->publicatiedatum\" href=\"$link->url\" target=\"_blank\">lees&hellip;</a></li>";
							}
						?>
                    </ul>
                    <p><a href="linkfeed.php">meer&hellip;</a></p>
                </div>
            </div>
        </div><!-- .row -->


        
    </div><!-- .container -->

    <!--
    <div class="panel-footer">
        <p class="center">
            Content door Erwin Abrahamse, Rudy Wouters en Adri Mathlener &bullet;
            SwiftDev.nl is lente 2016 opgericht door Erwin Schuurman, Erwin Abrahamse en Rudy Wouters &bullet;
            Website door Michiel Overtoom
        </p>
    </div>
    -->

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
