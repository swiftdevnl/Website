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
    <meta name="author" content="<?= $metaauthor ?>" />
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/swiftdev.css">
	<link rel="shortcut icon" href="../../img/favicon.png">    
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	  ga('create', 'UA-76481042-2', 'auto');
	  ga('send', 'pageview');
	</script>
</head>
<body class="artikel">
    <div class="top container-fluid">
    	<div class="container">
	        <div class="row">
            	<h1><a href="/"><img src="../../img/logo75.png" alt="<?= $contenttitle ?>" /></a></h1>
	        </div>
		</div>
	</div>

    <div class="container">
        <div class="row">
            <div class="col-center">
				<?= $content ?>
				<p><a href="/">&larr; home</a></p>
            </div>
        </div>
        
    </div><!-- .container -->

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
