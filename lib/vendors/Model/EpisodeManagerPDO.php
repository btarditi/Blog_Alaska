<?php
namespace Model;
 
use \Entity\Episode;
 
class EpisodeManagerPDO extends EpisodeManager
{
  public function getList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM episodes ORDER BY id DESC';
 
    if ($debut != -1 || $limite != -1)
    {
      $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
    }
 
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Episode');
 
    $listeEpisode = $requete->fetchAll();
 
    foreach ($listeEpisode as $episode)
    {
      $episode->setDateAjout(new \DateTime($episode->dateAjout()));
      $episode->setDateModif(new \DateTime($episode->dateModif()));
    }
 
    $requete->closeCursor();
 
    return $listeEpisode;
  }
 
  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM episodes WHERE id = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
 
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Episode');
 
    if ($episode = $requete->fetch())
    {
      $episode->setDateAjout(new \DateTime($episode->dateAjout()));
      $episode->setDateModif(new \DateTime($episode->dateModif()));
 
      return $episode;
    }
 
    return null;
  }
    
  protected function add(Episode $episode)
  {
    $requete = $this->dao->prepare('INSERT INTO episodes SET auteur = :auteur, titre = :titre, contenu = :contenu, dateAjout = NOW(), dateModif = NOW()');
    
    $requete->bindValue(':titre', $episode->titre());
    $requete->bindValue(':auteur', $episode->auteur());
    $requete->bindValue(':contenu', $episode->contenu());
    
    $requete->execute();
  }
    
  protected function modify(Episode $episode)
    {
        $requete = $this->dao->prepare('UPDATE episodes SET auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = NOW() WHERE id = :id');
        $requete->bindValue(':titre', $episode->titre());
        $requete->bindValue(':auteur', $episode->auteur());
        $requete->bindValue(':contenu', $episode->contenu());
        $requete->bindValue(':id', $episode->id(), \PDO::PARAM_INT);
        $requete->execute();
    }
    
  public function delete($id)
  {
    $this->dao->exec('DELETE FROM episodes WHERE id = '.(int) $id);
  }
}