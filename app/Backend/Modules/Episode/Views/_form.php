<form action="" method="post">
  <p>
    <?= isset($erreurs) && in_array(\Entity\Episode::AUTEUR_INVALIDE, $erreurs) ? 'L\'auteur est invalide.<br />' : '' ?>
    <label>Auteur</label>
    <input type="text" name="auteur" value="<?= isset($episode) ? $episode['auteur'] : '' ?>" /><br />
    
    <?= isset($erreurs) && in_array(\Entity\Episode::TITRE_INVALIDE, $erreurs) ? 'Le titre est invalide.<br />' : '' ?>
    <label>Titre</label><input type="text" name="titre" value="<?= isset($episode) ? $episode['titre'] : '' ?>" /><br />
    
    <?= isset($erreurs) && in_array(\Entity\Episode::CONTENU_INVALIDE, $erreurs) ? 'Le contenu est invalide.<br />' : '' ?>
    <label>Contenu</label><textarea rows="8" cols="60" name="contenu"><?= isset($episode) ? $episode['contenu'] : '' ?></textarea><br />
<?php
if(isset($episode) && !$episode->isNew())
{
?>
    <input type="hidden" name="id" value="<?= $episode['id'] ?>" />
    <input type="submit" value="Modifier" name="modifier" />
<?php
}
else
{
?>
    <input type="submit" value="Ajouter" />
<?php
}
?>
  </p>
</form>