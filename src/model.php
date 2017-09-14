<?php
function getepisode() {
    // Data Access
    $bdd = new PDO('mysql:host=localhost;dbname=blog_alaska;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $listEpisodes = $bdd->query('SELECT id, auteur, titre, contenu, dateAjout, dateModif  FROM episodes ORDER BY id ');
    return $listEpisodes;
    
}