<?php
namespace Model;
 
use \Entity\Commentaire;
 
class CommentaireManagerPDO extends CommentaireManager
{
  protected function insert(Commentaire $comment)
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
 
    $q = $this->dao->prepare('SELECT id, id_episode, auteur, contenu, date FROM commentaires WHERE id_episode = :id_episode');
    $q->bindValue(':id_episode', $id_episode, \PDO::PARAM_INT);
    $q->execute();
 
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Commentaire');
 
    $comments = $q->fetchAll();
  
    return $comments;
  }
  
  public function findAll()
    {
        $requete = $this->dao->query('SELECT id, id_episode, auteur, contenu, flag FROM commentaires ORDER BY flag DESC ');
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Commentaire');
        return $comments = $requete->fetchAll();
    }  
    
  public function find($id)
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
  
  public function deleteAllByEpisode($episodeId)
  {
    $this->dao->exec('DELETE FROM commentaires WHERE id_episode = '.(int) $id_episode);
  }
    
  public function deleteAllByUser($userId)
    {
        $this->dao->exec('DELETE FROM commentaires WHERE auteur ='. $userId);
    }
   
  public function flagToComment($id, $flag)
    {
        $q = $this->dao->prepare('UPDATE commentaires SET flag = :flag WHERE id = :id');
        $q->bindValue(':flag', $flag, \PDO::PARAM_INT);
        $q->bindValue(':id', $id, \PDO::PARAM_INT);
        $q->execute();
    }
    
  protected function update(Commentaire $comment)
  {
    $q = $this->dao->prepare('UPDATE commentaires SET auteur = :auteur, contenu = :contenu, flag = :flag WHERE id = :id');
    
    $q->bindValue(':auteur', $comment->auteur());
    $q->bindValue(':contenu', $comment->contenu());
    $q->bindValue(':id_episode', $comment->id_episode());
    $q->bindValue(':flag', $comment->flag());
    $q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
    
    $q->execute();
  }  
  
  public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM commentaires')->fetchColumn();
    }
  
  public function countCommentFlag()
    {
        return $this->dao->query('SELECT COUNT(*) FROM commentaires WHERE flag > 0 ')->fetchColumn();
    }
}