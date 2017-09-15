<?php
namespace Entity;
 
use \BTFram\Entity;
 
class Commentaire extends Entity
{
  protected $episode_id,
            $auteur,
            $contenu,
            $dateAjout,
            $flag;
 
  const AUTEUR_INVALIDE = 1;
  const CONTENU_INVALIDE = 2;
 
  public function isValid()
  {
    return !(empty($this->auteur) || empty($this->contenu));
  }
 // SETTER //
  public function setEpisode($episode)
  {
    $this->id_episode = (int) $episode;
  }
 
  public function setAuteur($auteur)
  {
    if (!is_string($auteur) || empty($auteur))
    {
      $this->erreurs[] = self::AUTEUR_INVALIDE;
    }
 
    $this->auteur = $auteur;
  }
 
  public function setContenu($contenu)
  {
    if (!is_string($contenu) || empty($contenu))
    {
      $this->erreurs[] = self::CONTENU_INVALIDE;
    }
 
    $this->contenu = $contenu;
  }
 
  public function setDateAjout(\DateTime $dateAjout)
  {
    $this->dateAjout = $dateAjout;
  }
 
 //  GETTER //
  public function episode_id()
  {
    return $this->episode_id;
  }
 
  public function auteur()
  {
    return $this->auteur;
  }
 
  public function contenu()
  {
    return $this->contenu;
  }
 
  public function dateAjout()
  {
    return $this->date;
  }
    
  public function flag()
    {
        return $this->flag;
    }
}