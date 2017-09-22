<h2 class="text-center">Tous les <?= $nbEpisode ?> episode </h2>

<header>
    <div class="jumbotron" id="jumbo3">
        <a class="btn btn-primary" href="/about.php">A propos de Jean Forteroche</a>
    </div>
</header>

<?php if(isset($listEpisode)): ?>
    <?php foreach ($listEpisode as $episode): ?>

        <div style="min-width: 380px!important;" class="col-lg-3 col-lg-offset-1 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1  panel panel-default">
            <div class="panel-heading">
                <h2 class="text-center">
                    <a href="chapter-<?= $episode['id'] ?>.html"><?= $episode['titre']; ?></a>
                </h2>
            </div>

            <div class="well">
                <?= nl2br($episode['contenu']); ?>
            </div>

            <div class="panel-footer">
                <?php if($episode['dateAjout'] != $episode['dateModif']): ?>
                    <p class="pull-right"><?= 'Dernières modification le ' . $episode['dateModif']->format(' d/m/Y à H\hi'); ?></p>
                <?php else: ?>
                    <p class="pull-right"><?= 'Publié le ' . $episode['dateAjout']->format(' d/m/Y à H\hi');   ?></p>
                <?php endif; ?>
                <a id="btn-episodeIndex" class="btn btn-success pull-right" href="episode-<?= $episode['id'] ?>.html">Lire la suite ...</a>
            </div>
        </div>

    <?php endforeach; ?>

<?php endif; ?>