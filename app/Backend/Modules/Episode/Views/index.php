<p style="text-align: center">Il y a actuellement <?= $nombreEpisode ?> episodes. En voici la liste :</p>
 
<table>
  <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
<?php
foreach ($listeEpisode as $episode)
{
  echo '<tr><td>', $episode['auteur'], '</td><td>', $episode['titre'], '</td><td>le ', $episode['dateAjout']->format('d/m/Y à H\hi'), '</td><td>', ($episode['dateAjout'] == $episode['dateModif'] ? '-' : 'le '.$episode['dateModif']->format('d/m/Y à H\hi')), '</td><td><a href="episode-update-', $episode['id'], '.html"><img src="/images/update.png" alt="Modifier" /></a> <a href="episode-delete-', $episode['id'], '.html"><img src="/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n";
}
?>
</table>