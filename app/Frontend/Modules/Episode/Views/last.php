    <hr>
        <h2 class="text-center">Les <?= $nbEpisode; ?> derniers épisodes </h2>
    <hr>

    <div class="row">

        <?php foreach ($listEpisode as $episode): ?>

            <article class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2 panel panel-default">    
                <h2 class="panel-heading text-center">
                    <a href="/episode/episode-<?= $episode->id(); ?>.html"><?= $episode->titre(); ?></a>
                </h2>
            
                <div class="well">
                    <p p class="panel-body">
                        <?= nl2br($episode->contenu()); ?>
                    </p>
                </div>

                <div class="well-sm">
                    <p>
                        <a  class="btn btn-success pull-right" href="/episode/episode-<?= $episode->id(); ?>.html">Lire la suite ...</a>
                    </p>
                    
                     <p class="text-center">
                        <?php if($episode->dateAjout() != $episode->dateModif()): ?>
                            <small><?= 'Modifié le ' . $episode->dateModif()->format(' d/m/Y à H\hi'); ?></small>
                        <?php else: ?>
                            <small><?= 'Publié le ' . $episode->dateAjout()->format(' d/m/Y à H\hi');   ?></small>
                        <?php endif; ?>
                    </p>
                </div>
            </article>

        <?php endforeach; ?>

    </div>