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
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <!-- My stylesheet of CSS -->
        <link href="./css/style.css" rel="stylesheet"  type="text/css"/>

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
                        <a class="navbar-brand" href="/">Billet simple pour l'Alaska</a>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-collapse-target">
                        <ul class="nav navbar-nav navbar-left">
                            <li class="active"><a href="/"><span class="glyphicon glyphicon-home"></span> Accueil</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Episodes <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="../episode/last.html">Derniers épisodes publiés</a></li>
                                    <li><a href="../episode/all.html"><span class="glyphicon glyphicon-book"></span> Tous les épisodes</a></li>
                                </ul>
                            </li>
                            <li><a href="../aPropos.html"><span class="glyphicon glyphicon-certificate"></span>  A propos</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php if (!$this->app->user()->isAuthenticated()) : ?>
                                <li><a href="/connexion/user.html"><span class="glyphicon glyphicon-log-in"></span> Se connecter</a></li>
                                <li><a href="/user/register.html"><span class="glyphicon glyphicon-save"></span> S'inscrire</a></li>
                            <?php endif; ?>
                            <?php if ($this->app->user()->isAdmin()) : ?>
                                <li><a href="./admin/index.html"><span class="glyphicon glyphicon-user"></span> Administration</a></li>
                            <?php endif; ?>
                            <?php if ($this->app->user()->isAuthenticated()) : ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bienvenue, <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/admin/disconnect.html"><span class="glyphicon glyphicon-unchecked"></span> Se deconnecter</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div><!-- /.container -->
            </nav>
        </header>

        <div id="bloc_content" class="container" style="margin-top: 140px;">

            <?php if ($this->app->user()->hasFlash()) : ?>
            <div id="flashMessage" class=" alert alert-success">
                <?= '<p class="text-center">' . $this->app->user()->getFlash() . '</p>'; ?>
            </div>
            <?php endif; ?>

            <?= $content ?>
            

        </div><!-- /#bloc_content .container -->



        <footer class="footer" >
            <a href="">Ce Blog</a> est une application réalisé par Bruno.
        </footer>


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"
                integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
                crossorigin="anonymous"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=pdrmf4bzda88287gylsko1q67ss9zm95ipd82ta1sw2dgnb2"></script>
        <script>
            jQuery(document).ready(function() {
                tinymce.init({
                    selector: '#tiny',
                    height: 200,
                    menubar: false,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table contextmenu paste code'
                    ],
                    toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                    content_css: [
                        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                        '//www.tinymce.com/css/codepen.min.css']
                });
            });
        </script>
    </body>
</html>