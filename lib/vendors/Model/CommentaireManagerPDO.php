<?php
namespace Model;
 
use \Entity\Commentaire;
 
class CommentaireManagerPDO extends CommentaireManager
{
    protected function insert(Commentaire $commentaire)
    {
        $q = $this->dao->prepare('INSERT INTO commentaires SET id_episode = :episodeId, auteur = :auteur, contenu = :contenu, date = NOW()');

        $q->bindValue(':episodeId', $commentaire->episodeId(), \PDO::PARAM_INT);
        $q->bindValue(':auteur', $comentaire->auteur());
        $q->bindValue(':contenu', $comentaire->contenu());

        $q->execute();

        $commentaire->setEpisodeId($this->dao->lastInsertId());
    }
    
    public function getListOf($episodeId)
    {
        if (!ctype_digit($episodeId))
        {
            throw new \InvalidArgumentException('L\'identifiant de l\'épisode passé doit être un nombre entier valide');
        }

        $q = $this->dao->prepare('SELECT id, id_episode, auteur, contenu, date FROM commentaires WHERE id_episode = :episodeId');
        $q->bindValue(':episodeId', $episodeId, \PDO::PARAM_INT);
        $q->execute();

        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Commentaire');

        $commentaires = $q->fetchAll();
        foreach ($commentaires as $commentaire)
        {
            $commentaire->setDate(new \DateTime($commentaire->date()));
        }
        return $commentaires;
    }
  
    public function getUnique($id)
    {
        $q = $this->dao->prepare('SELECT * FROM commentaires WHERE id = :id');
        $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $q->execute();
    
        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Commentaire');
    
        return $q->fetch();
    }
    
    public function getAll()
    {
        $sql = 'SELECT * FROM commentaires';
        $requete = $this->dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Commentaire');
        $listCommentaire = $requete->fetchAll();
//        foreach ($commentsList as $comment)
//        {
//            $comment->setDateCreate(new \DateTime($comment->setDateCreate()));
//        }
        $requete->closeCursor();
        return $listCommentaire;
    }
    
    public function delete($id)
    {
        $this->dao->exec('DELETE FROM commentaires WHERE id = '.(int) $id);
    }
  
    public function deleteFromEpisode($episodeId)
    {
        $this->dao->exec('DELETE FROM commentaires WHERE id_episode = '.(int) $episodeId);
    }
    
    protected function update(Commentaire $commentaire)
    {
        $q = $this->dao->prepare('UPDATE commentaires SET auteur = :auteur, contenu = :contenu WHERE id = :id');

        $q->bindValue(':auteur', $commentaire->auteur());
        $q->bindValue(':contenu', $commentaire->contenu());
        $q->bindValue(':id', $commentaire->id(), \PDO::PARAM_INT);

        $q->execute();
    }  
    
    public function deleteFromUser($auteur)
    {
        $this->dao->exec('DELETE FROM commentaires WHERE auteur ='.  $auteur);
    }
    
    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM commentaires')->fetchColumn();
    }
  
}
  
