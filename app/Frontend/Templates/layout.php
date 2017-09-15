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

                    <div class="collapse navbar-collapse" id="navbar-collapse-target">
                        <ul class="nav navbar-nav navbar-left">
                            <li class="active"><a href="/"><span class="glyphicon glyphicon-home"></span> Accueil</a></li>
                            <li><a href="login.php"><span class="glyphicon glyphicon-save"></span> Inscription</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Chapitres <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                        <li><a href="../les-cinq-derniers-chapitres.html">Derniers épisodes publiés</a></li>
                                        <li><a href="../tous-les-chapitres-publier.html"><span class="glyphicon glyphicon-book"></span> Tous les épisodes</a></li>
                                </ul>
                            </li>
                            <li><a href="../aPropos.html"><span class="glyphicon glyphicon-certificate"></span>  A propos</a></li>

                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php if(!$user->isAuthenticated()): ?>
                                <li><a href="/connexion/user.html"><span class="glyphicon glyphicon-log-in"></span> Se connecter</a></li>
                                <li><a href="/users/register.php"><span class="glyphicon glyphicon-save"></span> Inscription</a></li>
                            <?php endif; ?>
                            <?php if ($user->isAdmin()) : ?>
                                <li><a href="./admin/home.html"><span class="glyphicon glyphicon-user"></span> Administration</a></li>
                            <?php endif; ?>
                            <?php if($user->isAuthenticated()): ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bienvenue, <?= $user['username'] ?> <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/connexion/disconnect.html"><span class="glyphicon glyphicon-unchecked"></span> Se deconnecter</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div><!-- /.container -->
            </nav>
        </header>


        <div id="bloc_content" class="container" >

            <?php if ($user->hasFlash()): ?>
                <div id="flashMessage" class=" alert alert-info">
                    <?= '<p class="text-center">' . $user->getFlash() . '</p>';  ?>
                </div>
            <?php endif; ?>

            <?= $content ?>

<?= var_dump($_SESSION) ?>
<?= var_dump($_SERVER['REQUEST_URI']) ?>

        </div><!-- /#bloc_content .container -->



        <footer class="footer" >
            <a href="">This Blog</a> est une application réalisé Bruno.
        </footer>


            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="./lib/jQuery/jquery.slim.min.js"></script>
            <!-- Latest compiled and minified JavaScript -->
        <script src="./lib/bootstrap/js/bootstrap.min.js"></script>
        
        <script src="./lib/TinyMCE/tinymce.min.js"></script>
        <script>
            $( document ).ready(function() {
                tinymce.init({
                    selector: 'textarea',
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