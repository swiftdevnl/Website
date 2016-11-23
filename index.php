<?php

// Haal bestaande agendapunten, indien die aanwezig zijn.
$jsonfilename = "state/agenda.json";
$agenda = new stdClass();
if (file_exists($jsonfilename)) {
	$agenda = json_decode(file_get_contents($jsonfilename));
	}

?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- De bovenstaande drie metatags moeten persé boven dit commentaar staan, andere tags hieronder -->
    <title>SwiftDev.nl - Nederlandstalige community van iOS ontwikkelaars</title>
    <meta name="keywords" content="iOS, apps, iPhone, iPad, Nederlandstalig, swift, programmeren, app maken, tutorial, handleiding, leren" />
    <meta name="description" content="TODO: Beschrijving in 130 tot 150 tekens" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/swiftdev.css">
	<link rel="shortcut icon" href="img/favicon.png">    
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
            <h1><a href="/"><img src="img/logo75.png" alt="SwiftDev.nl" /></a></h1>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <div class="squeeze-left">
                    <h2>SwiftDev.nl</h2>
                    <p>...is een <em>online Nederlandstalige community</em> van personen die iOS apps willen maken, en dat samen doen is gezelliger!</p>
                    <p class="center breathe"><a target="_blank" class="btn btn-success" href="https://discord.gg/jjqzBA4">naar Discord kanaal &rarr;</a></p>
                    <p>Online coding sessies via <a href="https://zoom.us/download#client_4meeting">zoom.us</a> worden in dit kanaal georganiseerd.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="squeeze-middle">
                    <h2>Online meetings</h2>
                    <ul class="unindented">
                    <li>Elke zondagmiddag live coding sessie</li>
                    <li>Tweewekelijks woensdagavond hangout</li>
                    <li><a href="artikels/videos">Bekijk videos</a> van vorige hangouts</li>
                    <li>Blijf op de hoogte via email:</li>
                    </ul>
                    <form class="subscribe" method="post" action="abonneer.php" accept-charset="utf-8">
                        <div class="input-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="jouw email adres">
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
                    <p>Zondag <?php if (!empty($agenda->zondagdatum)) echo($agenda->zondagdatum); ?> 14:00, <a href="https://zoom.us/j/456434309" title="Live coding sessie">zoom &rarr;</a></p>
                    <ul class="indented">
						<?php if (!empty($agenda->zondagpunt1)) echo("<li>".$agenda->zondagpunt1."</li>"); ?>
						<?php if (!empty($agenda->zondagpunt2)) echo("<li>".$agenda->zondagpunt2."</li>"); ?>
						<?php if (!empty($agenda->zondagpunt3)) echo("<li>".$agenda->zondagpunt3."</li>"); ?>
                    </ul>
                    <p>Woensdag <?php if (!empty($agenda->woensdagdatum)) echo($agenda->woensdagdatum); ?> 19:30, <a href="https://zoom.us/j/245766538" title="Hangout">zoom &rarr;</a></p>
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
                    <h2>Link feed</h2>
                    <p>Interessante internationale artikelen en blogpostings, verzameld door Digitist.</p>
                    <ul class="unindented">                        
                        <li>Bouw <a date="2016-11-02" href="https://www.raywenderlich.com/140836/firebase-tutorial-real-time-chat-2">realtime chat</a> in je app met FireBase</li>
                        <li>Met SpriteKit een zg. <a date="2016-11-02" href="https://www.raywenderlich.com/143258/make-waiting-game-like-farmville-spritekit-swift">'Waiting Game'</a> maken</li>
                        <li>De <a date="2016-11-02" href="https://github.com/raywenderlich/swift-algorithm-club">Swift Algorithm Club</a> bevat allerlei algorithmen in Swift playgrounds</li>
                        <li>Matt Heaney is begonnen met een <a href="https://www.youtube.com/playlist?list=PLrL5aCF7Ods-bmw86QdMT4B8FPhD7D99P">serie tutorials over Swift 3</a> gericht op beginners</li>
                        <li><a href="https://medium.com/ios-os-x-development/xcode-a-better-way-to-deal-with-storyboards-8b6a8b504c06#.p7r31tml3">Hoe om te gaan met Story Boards</a>, size classes etc.</li>
                        <li>Een mooi overzicht van <a href="http://www.globalnerdy.com/2015/03/02/microsofts-swiftc-cheat-sheet/">Swift &amp; C#</a> commando's</li>
                    </ul>
                    <p><a href="#">meer&hellip;</a></p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="squeeze-middle">
                    <h2>Apps van leden</h2>
                    <p>Een aantal leden hebben apps gemaakt die ondertussen in de AppStore staan.</p>
                    <p><a href="artikels/quotespin">Quote Spin</a> van Pieter Velghe</p>
                    <p><a href="artikels/logsave">LogSave</a> van Jan Pollaert</p>
                    <p><a href="artikels/horseranking">Horse Ranking</a> van Michel Kapelle</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="squeeze-right">
                    <h2>Over SwiftDev</h2>
                    <p>
                        Wil jij in het Nederlands met Swift ook iOS apps leren programmeren,
                        apps ontwerpen of samen met anderen apps ontwikkelen?
                        <a href="artikels/over">Lees dan verder&hellip;</a>
                    </p>
                    
                    <p>
                        Voor wie kennis wil maken met Swift, app-ontwikkeling en andere leden bezoekt wekelijks
                        onze <em>online meetings</em>. We gaan samen aan de slag, wisselen ideeën uit, beantwoorden vragen,
                        bespreken gezamenlijke projecten én geven uitleg over interessante onderwerpen.
                        <a href="artikels/meetings">Lees meer&hellip;</a>
                    </p>
                
                    <p>
                        Een systeem om artikelen toe te voegen zonder een CMS te hoeven gebruiken.
                        <a href="artikels/skelet">Lees meer&hellip;</a>
                    </p>
                
                    <p><a href="artikels/overzicht">meer artikels&hellip;</a>
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
