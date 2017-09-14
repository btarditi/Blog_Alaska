<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link href="style.css" rel="stylesheet" />
        <title>Blog_Alaska - Accueil</title>
    </head>

    <body>
        <header>
            <h1>Billet simple pour l'Alaska </h1>
        </header>

        <div id="bloc_content">

            <?php
                $bdd = new PDO('mysql:host=localhost;dbname=blog_alaska;charset=utf8', 'root', '');
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $posts = $bdd->query('SELECT * FROM episodes ORDER BY id ');
            foreach ($posts as $post) : ?>
                <article>
                    <h2><?= $post['titre'] ?></h2>
                    <p><?= $post['contenu'] ?></p>
                </article>
            <?php endforeach; ?>
        </div> <!-- /#bloc_content -->

        <footer class="footer">
            <a href="#">Blog_alaska</a> est un Blog réalisé par Bruno.
        </footer>

    </body>
</html>