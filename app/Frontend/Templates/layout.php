<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Projet 3 Formation CDP Multimédia ">
        <meta name="author" content="Bruno Tarditi">
        <link rel="icon" href="../../favicon.ico">

        <title>
            <?= isset($titre) ? $titre : 'Billet simple pour l\'Alaska' ?>
        </title>

        <!-- Bootstrap core CSS -->
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- My stylesheet of CSS -->
        <link href="./css/style.css" rel="stylesheet" type="text/css" />
<!--        <link href="./css/Envision.css" rel="stylesheet" type="text/css" />-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <header>
                <!-- The NavBar System -->
            <nav class="navbar navbar-inverse ">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/">Billet simple pour l'Alaska</a>
                    </div><!-- /.navbar-header -->

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="active"><a href="/"><span class="glyphicon glyphicon-home"></span> Accueil</a></li>
                            <li><a href="/all_chapters"><span class="glyphicon glyphicon-book"></span> Tous les chapitres</a></li>
                            <?php //if ($user->isAuthenticated()): ?>
                                <li><a href="/admin/">Administration</a></li>
                                <li><a href="/admin/episode-insert.html">Ajouter un épisode</a></li>
                            <?php //endif ?>
                        </ul>
                    </div>
                </div><!-- /.container -->
            </nav>
        </header>


        <div id="bloc_content" class="container" >

            <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>

            <?= $content ?>


        </div><!-- /#bloc_content .container -->



        <footer class="footer" >
            <a href="">This Blog</a> est une application réalisé Bruno.
        </footer>


            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="./lib/jQuery/jquery.slim.min.js"></script>
            <!-- Latest compiled and minified JavaScript -->
        <script src="./lib/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>