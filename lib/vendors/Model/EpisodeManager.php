<?php
namespace Model;
 
use \BTFram\Manager;
use \Entity\Episode;
 
abstract class EpisodeManager extends Manager
{
    
   /**
   * Méthode permettant d'ajouter un épisode.
   * @param $episode Episode L'épisode à ajouter
   * @return void
   */
  abstract protected function add(Episode $episode);
  
  /**
   * Méthode permettant d'enregistrer un episode.
   * @param $news News la news à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(Episode $episode)
  {
    if ($episode->isValid())
    {
      $episode->isNew() ? $this->add($episode) : $this->modify($episode);
    }
    else
    {
      throw new \RuntimeException('L\'épisode doit être validée pour être enregistrée');
    }
  } 
   
   /**
   * Méthode retournant une liste de news demandée.
   * @param $debut int La première news à sélectionner
   * @param $limite int Le nombre de news à sélectionner
   * @return array La liste des news. Chaque entrée est une instance de News.
   */
  abstract public function getList($debut = -1, $limite = -1);
   
    /**
   * Méthode retournant une news précise.
   * @param $id int L'identifiant de la news à récupérer
   * @return News La news demandée
   */
  abstract public function getUnique($id);
    
    /**
   * Méthode renvoyant le nombre de news total.
   * @return int
   */
   public function count()
  {
    return $this->dao->query('SELECT COUNT(*) FROM news')->fetchColumn();
  } 
    
    /**
   * Méthode permettant de modifier une news.
   * @param $news news la news à modifier
   * @return void
   */
  abstract protected function modify(News $news);
    
    /**
   * Méthode permettant de supprimer une news.
   * @param $id int L'identifiant de la news à supprimer
   * @return void
   */
  abstract public function delete($id);
   
    
  
    
  
}