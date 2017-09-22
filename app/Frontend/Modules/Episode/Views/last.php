<h2 class="text-center" style="margin-bottom: 30px;">Les <?= $nbEpisode ?> derniers épisodes </h2>

    <header >
        <div class="jumbotron col-xs-8 col-xs-offset-2" id="jumbo1">
        </div>
    </header>

    <div class="row">
        <?php if ($user->hasFlash()): ?>
            <div id="flashMessage" >
                <?= '<p class="alert alert-warning text-center">' . $user->getFlash() . '</p>';  ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="row">

        <?php foreach ($listEpisode as $episode): ?>

            <div style="min-width: 380px!important;" class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2 panel panel-default">
                <div class="panel-heading">
                    <h2 class="text-center">
                        <a href="./episode-<?= $episode['id'] ?>.html"><?= $episode['titre']; ?></a>
                    </h2>
                </div>

                <div class="well">
                    <?= nl2br($episode['contenu']); ?>
                </div>

                <div class="panel-footer">
                    <?php if($episode['dateAjout'] != $episode['dateModif']): ?>
                        <p class="pull-left"><?= 'Dernières modification le ' . $episode['lastModif']->format(' d/m/Y à H\hi'); ?></p>
                    <?php else: ?>
                        <p class="pull-left"><?= 'Publié le ' . $episode['dateAjout']->format(' d/m/Y à H\hi');   ?></p>
                    <?php endif; ?>
                    <a  class="btn btn-success pull-right" href="./episode-<?= $episode['id'] ?>.html">Lire la suite ...</a>
                </div>
            </div>

        <?php endforeach; ?>

    </div>