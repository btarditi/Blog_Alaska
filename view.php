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
<?php var_dump($listEpisodes); ?>
            <?php foreach ($listEpisodes as $post) : ?>
                <article>
                    <h2><?= $post['titre'] ?></h2>
                    <p><?= $post['contenu'] ?></p>
                </article>
            <?php endforeach ?>
        </div> <!-- /#bloc_content -->

        <footer class="footer">
            <a href="#">Blog_alaska</a> est un Blog réalisé par Bruno.
        </footer>

    </body>
</html>
