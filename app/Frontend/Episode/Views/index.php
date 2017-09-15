<?php
    foreach ($episodeList as $episode)
    {
        ?>
        <h2><a href="episode-<?= $episode['id'] ?>.html"><?= $episode['titre'] ?></a></h2>
        <p><?= nl2br($episode['contenu']) ?></p>

        <?php
}