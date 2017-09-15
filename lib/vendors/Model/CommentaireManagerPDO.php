<?php
namespace Model;
 
use \Entity\Commentaire;
 
class CommentaireManagerPDO extends CommentaireManager
{
  protected function add(Commentaire $comment)
  {
    $q = $this->dao->prepare('INSERT INTO commentaires SET id_episode = :id_episode, auteur = :auteur, contenu = :contenu, date = NOW()');
 
    $q->bindValue(':id_episode', $comment->id_episode(), \PDO::PARAM_INT);
    $q->bindValue(':auteur', $comment->auteur());
    $q->bindValue(':contenu', $comment->contenu());
 
    $q->execute();
 
    $comment->setId($this->dao->lastInsertId());
  }
    
  public function getListOf($id_episode)
  {
    if (!ctype_digit($id_episode))
    {
      throw new \InvalidArgumentException('L\'identifiant de l\'épisode passé doit être un nombre entier valide');
    }
 
    $q = $this->dao->prepare('SELECT id, id_episode, auteur, contenu, date FROM commentaires WHERE id_episode = :id_episodenews');
    $q->bindValue(':id_episode', $id_episode, \PDO::PARAM_INT);
    $q->execute();
 
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Commentaire');
 
    $comments = $q->fetchAll();
 
    foreach ($comments as $comment)
    {
      $comment->setDate(new \DateTime($comment->date()));
    }
 
    return $comments;
  }
  
  protected function modify(Commentaire $comment)
  {
    $q = $this->dao->prepare('UPDATE commentaires SET auteur = :auteur, contenu = :contenu WHERE id = :id');
    
    $q->bindValue(':auteur', $comment->auteur());
    $q->bindValue(':contenu', $comment->contenu());
    $q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
    
    $q->execute();
  }
    
  public function get($id)
  {
    $q = $this->dao->prepare('SELECT id, id_episode, auteur, contenu FROM commentaires WHERE id = :id');
    $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $q->execute();
    
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Commentaire');
    
    return $q->fetch();
  }
    public function delete($id)
  {
    $this->dao->exec('DELETE FROM commentaires WHERE id = '.(int) $id);
  }
  
  public function deleteFromEpisode($id_episode)
  {
    $this->dao->exec('DELETE FROM commentaires WHERE id_episode = '.(int) $id_episode);
  }
    
  
    
    
}