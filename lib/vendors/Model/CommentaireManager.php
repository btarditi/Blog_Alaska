<?php
namespace Model;
 
use \BTFram\Manager;
use \Entity\Commentaire;
 
abstract class CommentaireManager extends Manager
{
  
/**
   * Méthode permettant d'enregistrer un commentaire.
   * @param $comment Le commentaire à enregistrer
   * @return void
   */
  public function save(Commentaire $comment)
  {
    if ($comment->isValid())
    {
      $comment->isNew() ? $this->insert($comment) : $this->update($comment);
    }
    else
    {
      throw new \RuntimeException('Le commentaire doit être validé pour être enregistré');
    }
  }    
  
/**
     * Insert a new Comment in BDD
     * @param $comment Comments The comment to insert
     * @return void
     */
  abstract protected function insert(Commentaire $comment);

    
  /**
   * Méthode permettant d'ajouter un commentaire.
   * @param $comment Le commentaire à ajouter
   * @return void
   */
  abstract protected function update(Commentaire $comment);
 
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
  abstract public function deleteAllByEpisode($episodeId);
    
/**
     * Remove all comments for a User
     * @param $userId Comments The user id
     * @return void
     */
    abstract public function deleteAllByUser($userId);
    
 /**
     * Returns a comment matching the supplied id.
     * @param integer $id The comment id.
     * @return \Entity\Comments|throw an exception if no matching comment is found
     */
    abstract public function find($id);
 
/**
     * Find all Comments for all Chapters
     * @return Comments
     */
    abstract public function findAll();
    
  /**
   * Méthode permettant de récupérer une liste de commentaires.
   * @param $news La news sur laquelle on veut récupérer les commentaires
   * @return array
   */
  abstract public function getListOf($episode);
  
/**
     * Méthode permettant de récupérer le nombre totale de commentaires.
     * @return array
     */
    abstract public function count();
 
/**
     * Méthode permettant de récupérer le nombre commentaires signalé.
     * @return array
     */
    abstract public function countCommentFlag();
 
/**
     * Add flag's to the comment
     * @param $id Comments The comments id
     * @param $flag Comments The number of Flag
     * @return void
     */
    abstract public function flagToComment($id, $flag);
    
}