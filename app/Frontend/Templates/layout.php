<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Projet 3 Formation CDP Multimédia " />
        <meta name="author" content="Bruno Tarditi" />
        <link rel="icon" href="/img/book.png" />

        <title>
            <?= isset($titre) ? $titre : 'Billet simple pour l\'Alaska' ?>
        </title>

        <!-- Bootstrap core CSS -->
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="/css/style.css" type="text/css" rel="stylesheet" />
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <header>
            <!-- The NavBar -->
            <nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-target">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-collapse-target">
                        <ul class="nav navbar-nav navbar-left">
                            <li><a href="/"><span class="glyphicon glyphicon-home"></span> Accueil</a></li>
                            <li><a href="/episode/last.html"><span class="glyphicon glyphicon-book"></span> Les derniers épisodes publiés</a></li>
                            <li><a href="/episode/all.html"><span class="glyphicon glyphicon-book"></span> Tous les épisodes</a></li>
                            <li><a href="../a-propos.html"><span class="glyphicon glyphicon-certificate"></span>  A propos</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php if ($user->isAdmin()) : ?>
                                <li><a href="/admin/index.html"><span class="glyphicon glyphicon-cog"></span> Administration</a></li>
                            <?php endif; ?>
                            <?php if (!$user->isAuthenticated()) : ?>
                                <li><a href="/admin/connect.html"><span class="glyphicon glyphicon-log-in"></span> Se connecter</a></li>
                                <li><a href="/admin/inscription.html"><span class="glyphicon glyphicon-user"></span> S'inscrire</a></li>
                            <?php endif; ?>
                            <?php if ($user->isAuthenticated()) : ?>
                                <li><a href="/admin/disconnect.html"><span class="glyphicon glyphicon-unchecked"></span> Se deconnecter</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div><!-- /.container -->
            </nav>
        </header>
        
        <div id="bloc_content" class="container">
            <div class="row">
                <header class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2">
                    <div class="jumbotron" id="jumbo1">
                    </div>
                </header>
            </div>
            
            <?php if ($user->hasFlash()) : ?>
            <div id="flashMessage" class=" alert alert-success">
                <?= '<p class="text-center">' . $user->getFlash() . '</p>'; ?>
            </div>
            <?php endif; ?>

             <!-- INSERTION DU CONTENUE -->
            <?php echo '<div>' . $content . '</div>' ?>

            

        </div><!-- /#bloc_content .container -->


        <!--  FOOTER   -->
        <div class="container-fluid">
            <div class="row">
                <footer class="footer">
                    <p class=" text-center">
                        <a href="">Ce Blog</a> est une application réalisé par Bruno.
                    </p>
                </footer>
            </div>
        </div>
        
              
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
    </body>
</html>