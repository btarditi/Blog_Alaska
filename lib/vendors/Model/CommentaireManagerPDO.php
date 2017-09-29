<?php
namespace Model;
 
use \Entity\Commentaire;

/**
 * Class CommentaireManagerPDO
 * Gestion des requetes commentaire. 
 */
 
class CommentaireManagerPDO extends CommentaireManager
{
    protected function insert(Commentaire $commentaire)
    {
        $q = $this->dao->prepare('INSERT INTO commentaires SET episodeId = :episodeId, auteur = :auteur, contenu = :contenu, date = NOW(), flag = 0');

        $q->bindValue(':episodeId', $commentaire->episodeId(), \PDO::PARAM_INT);
        $q->bindValue(':auteur', $commentaire->auteur());
        $q->bindValue(':contenu', $commentaire->contenu());

        $q->execute();

        
    }
    
    public function getList($debut = -1, $limite = -1)
    {
        $sql = "SELECT * FROM commentaires ";
        if($debut != -1 || $limite != -1)
        {
            $sql .= ' LIMIT ' . (int) $limite . ' OFFSET ' . (int) $debut;
        }
        $requete = $this->dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Commentaire');
        $listCommentaire = $requete->fetchAll();
        foreach ($listCommentaire as $commentaire)
        {
            $commentaire->setDateCreate(new \DateTime($commentaire->dateCreate()));
        }
        $requete->closeCursor();
        return $listCommentaire;
    }
    
    protected function update(Commentaire $commentaire)
    {
        $q = $this->dao->prepare('UPDATE commentaires SET episodeId = :episodeId, auteur = :auteur, contenu = :contenu, flag = :flag WHERE id = :id');
        
        $q->bindValue(':episodeId', $commentaire->episodeId());
        $q->bindValue(':auteur', $commentaire->auteur());
        $q->bindValue(':contenu', $commentaire->contenu());
        $q->bindValue(':flag', $commentaire->flag());
        
        $q->bindValue(':id', $commentaire->id(), \PDO::PARAM_INT);

        $q->execute();
    }  
    
    public function delete($id)
    {
        $this->dao->exec('DELETE FROM commentaires WHERE id = '.(int) $id);
    }
    
    public function deleteFromEpisode($episodeId)
    {
        $this->dao->exec('DELETE FROM commentaires WHERE episodeId = '.(int) $episodeId);
    }
    
    public function getListOf($episodeId)
    {
        if (!ctype_digit($episodeId))
        {
            throw new \InvalidArgumentException('L\'identifiant de l\'épisode passé doit être un nombre entier valide');
        }

        $q = $this->dao->prepare('SELECT * FROM commentaires WHERE episodeId = :episodeId');
        $q->bindValue(':episodeId', $episodeId, \PDO::PARAM_INT);
        $q->execute();

        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Commentaire');

        $commentaire = $q->fetchAll();
        
        return $commentaire;
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

        $requete->closeCursor();
        return $listCommentaire;
    }
    
    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM commentaires')->fetchColumn();
    }
  
    public function countCommentflag()
    {
        return $this->dao->query('SELECT COUNT(*) FROM commentaires WHERE flag <> 0 ')->fetchColumn();
    }
    
    public function getListOfCommentflag()
    {
        $sql = 'SELECT * FROM commentaires WHERE flag <> 0';
        
        $requete = $this->dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Commentaire');
        $listCommentFlag = $requete->fetchAll();
        $requete->closeCursor();
        return $listCommentFlag;
    }
}
  
