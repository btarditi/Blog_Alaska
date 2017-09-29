<?php
namespace Model;
 
use \BTFram\Manager;
use \Entity\Commentaire;

/**
 * Class CommentaireManager
 * Gestion des commentaires. 
 */
abstract class CommentaireManager extends Manager
{
  
/**
  * Méthode permettant d'ajouter un commentaire.
  * @param $comment Le commentaire à ajouter
  * @return void
*/
    abstract protected function insert(Commentaire $commentaire);

/**
   * Méthode permettant d'enregistrer un commentaire.
   * @param $comment Le commentaire à enregistrer
   * @return void
   */
    public function save(Commentaire $commentaire)
    {
        if ($commentaire->isValid())
        {
            $commentaire->isNew() ? $this->insert($commentaire) : $this->update($commentaire);
        }
        else
        {
            throw new \RuntimeException('Le commentaire doit être validé pour être enregistré');
        }
  }
    
/**
  * Méthode permettant d'ajouter un commentaire.
  * @param $comment Le commentaire à ajouter
  * @return void
  */
    abstract protected function update(Commentaire $commentaire);
    
/**
   * Méthode permettant de supprimer un commentaire.
   * @param $id L'identifiant du commentaire à supprimer
   * @return void
   */
    abstract public function delete($id);
    
/**
   * Méthode permettant de supprimer tous les commentaires liés à une news
   * @param $news L'identifiant de la news dont les commentaires doivent être supprimés
   * @return void
   */
    abstract public function deleteFromEpisode($episodeId);

/**
   * Méthode permettant de récupérer une liste de commentaires.
   * @param $news La news sur laquelle on veut récupérer les commentaires
   * @return array
   */
    abstract public function getListOf($episodeId);
    
/**
   * Méthode permettant d'obtenir un commentaire spécifique.
   * @param $id L'identifiant du commentaire
   * @return Comment
   */
    abstract public function getUnique($id);

/**
     * Find all Comments for all Chapters
     * @return Comments
     */
    abstract public function getAll();
    
/**
     * Méthode permettant de récupérer le nombre totale de commentaires.
     * @return array
     */
    abstract public function count();
    
/**
     * Méthode permettant de récupérer le nombre commentaires signalé.
     * @return array
     */
    abstract public function countCommentflag();

/**
     * Get all signaled comments
     * @return Comments
     */
    abstract public function getListOfCommentflag();
    
}