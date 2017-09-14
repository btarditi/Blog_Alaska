<div class="starter-template" >
            <h1>Je suis la page d'accueil</h1>

            <?php foreach ($listEpisodes as $post) {
                ?>
                <article>
                    <h2><?= $post['titre'] ?></h2>
                    <p><?= $post['contenu'] ?></p>
                </article>

                <?php
            }
            ?>

            <p><a href="?p=episode">Page épisode</a></p>
        </div>