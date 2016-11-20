<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- De bovenstaande drie metatags moeten persé boven dit commentaar staan, andere tags hieronder -->
    <title><?= $metatitle ?></title>
    <meta name="keywords" content="<?= $metakeywords ?>" />
    <meta name="description" content="<?= $metadescription ?>" />
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
<body class="artikel">
    <div class="container">
        <div class="row">
            <div class="col-center">
            	<h1><a href="/"><img src="../img/logo75.png" alt="SwiftDev.nl" /></a></h1>
				<?= $content ?>
				<p><a href="..">&larr; terug</a></p>
            </div>
        </div>
        
    </div><!-- .container -->

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
