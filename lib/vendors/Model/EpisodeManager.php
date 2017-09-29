<?php
namespace Model;
 
use \BTFram\Manager;
use \Entity\Episode;

/**
 * Class EpisodeManager
 * Gestion des episodes. 
 */
abstract class EpisodeManager extends Manager
{
    
/**
* Méthode permettant d'ajouter un épisode.
* @param $episode Episode L'épisode à ajouter
* @return void
*/
    abstract protected function insert(Episode $episode);
 
/**
* Méthode permettant d'enregistrer un episode.
* @param $episode Episode l'épisode à enregistrer
* @see self::add()
* @see self::modify()
* @return void
*/
    public function save(Episode $episode)
    {
    if ($episode->isValid())
    {
      $episode->isNew() ? $this->insert($episode) : $this->update($episode);
    }
    else
    {
      throw new \RuntimeException('L\'épisode doit être validée pour être enregistrée');
    }
  } 
   
/**
  * Méthode retournant une liste de l'épisode demandée.
  * @param $debut int du premier episode à sélectionner
  * @param $limite int Le nombre d'episode à sélectionner
  * @return array La liste des episodes. Chaque entrée est une instance de Episode.
*/
    abstract public function getList($debut = -1, $limite = -1);
   
/**
* Méthode retournant un épisode précis.
* @param $id int L'identifiant de l'épisode à récupérer
* @return Episode L'épisode demandé
*/
    abstract public function getUnique($id);
    
/**
     * Méthode retournant un épisode précis.
     * @return array La liste de tous les épisodes. Chaque entrée est une instance de Episode.
     */
    abstract public function getAll();

/**
   * Méthode renvoyant le nombre d'épisode total.
   * @return int
   */
    abstract public function count();
   
/**
   * Méthode permettant de modifier un épisode.
   * @param $episode Episode l'épisode à modifier
   * @return void
   */
    abstract protected function update(Episode $episode);

/**
   * Méthode permettant de supprimer un épisode.
   * @param $id int L'identifiant de l'épisode à supprimer
   * @return void
   */
    abstract public function delete($id);
}