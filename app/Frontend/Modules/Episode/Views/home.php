<h2 class="text-center" style="margin-top: 80px;">Bienvenue</h2>

    <header >
        <div class="jumbotron" id="jumbo1">
            
        </div>
    </header>


    <div class="row">

        <?php foreach ($episodeList as $episode) { ?>
            <article class="col-lg-3 col-md-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1  panel panel-default">
                <h2 class="panel-heading text-center">
                    <a href="episode-<?= $episode['id'] ?>.html"><?= $episode['titre'] ?></a>
                </h2>
                <div class="well">
                    <p class="panel-body">
                        <?= nl2br(strip_tags($episode['contenu'])) ?>
                    </p>
                    <p><a id="btn-episodeIndex" class="btn btn-success pull-right" href="episode-<?= $episode['id'] ?>.html">Lire la suite ...</a></p>
                </div>
                <div class="panel-footer">
                    <p class="text-center">
                        <?php if($episode['dateAjout'] != $episode['dateModif']): ?>
                            <?= 'Dernières modification le ' . $episode['dateModif']->format(' d/m/Y à H\hi');   ?>
                        <?php else: ?>
                            <?= 'Publié le ' . $episode['dateAjout']->format(' d/m/Y à H\hi');   ?>
                        <?php endif; ?>
                    </p>
                </div>
            </article>
        <?php } ?>

    </div>