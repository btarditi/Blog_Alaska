<form action="" method="post">
        <p>
        <?= isset($errors) && in_array(\Entity\Commentaire::AUTEUR_INVALIDE, $errors) ? 'L\'auteur est invalide.<br />' : '' ?>
        <label>Pseudo</label><input type="text" name="pseudo" value="<?= htmlspecialchars($comment['auteur']) ?>" /><br />

        <?= isset($errors) && in_array(\Entity\Commentaire::CONTENU_INVALIDE, $errors)) ? 'Le contenu est invalide.<br />' : '' ?>

        <label>Contenu</label><textarea name="contenu" rows="7" cols="50"><?= htmlspecialchars($comment['contenu']) ?></textarea><br />

        <input type="hidden" name="episode" value="<?= $comment['episode'] ?>" />
        <input type="submit" value="Modifier" />

        </p>
</form> 