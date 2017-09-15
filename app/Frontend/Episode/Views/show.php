<p>Par <em><?= $episode['auteur'] ?></em>, le <?= $episode['dateAjout']->format('d/m/Y à H\hi') ?></p>
<h2><?= $episode['titre'] ?></h2>
<p><?= nl2br($episode['contenu']) ?></p>

<?php if ($episode['dateAjout'] != $episode['dateModif']) { ?>
    <p style="text-align: right;"><small><em>Modifiée le <?= $episode['dateModif']->format('d/m/Y à H\hi') ?></em></small></p>
<?php } ?>

<p><a href="commenter-<?= $episode['id'] ?>.html">Ajouter un commentaire</a></p>

<?php
if (empty($comment))
{
    ?>
    <p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
    <?php
}
foreach ($comments as $comment)
{
    ?>
    <fieldset>
        <legend>
            Posté par <strong><?= htmlspecialchars($comment['auteur']) ?></strong> le <?= $comment['dateAjout']->format('d/m/Y à H\hi') ?>
            <?php if ($user->isAuthenticated()) { ?> -
                <a href="admin/comment-update-<?= $comment['id'] ?>.html">Modifier</a> |
                <a href="admin/comment-delete-<?= $comment['id'] ?>.html">Supprimer</a> |
            <?php } ?>
        </legend>
        <p><?= nl2br(htmlspecialchars($comment['contenu'])) ?></p>
    </fieldset>
    <?php
}
?>

<p><a href="commenter-<?= $episode['id'] ?>.html">Ajouter un commentaire</a></p>