<?php
namespace Entity;
 
use \BTFram\Entity;
use DateTime;

/**
 * Class Commentaire
 */
 
class Commentaire extends Entity
{
    protected $episodeId, // Id de l'épisode concernant le commentaire
              $auteur,  
              $contenu,
              $date,
              $flag;
             
    const AUTEUR_INVALIDE = 1;
    const CONTENU_INVALIDE = 2;
 
    public function isValid()
    {
        return !(empty($this->auteur) || empty($this->contenu));
    }

// SETTER //
    public function setEpisodeId($episodeId)
    {
        $this->episodeId = (int) $episodeId;
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
 
    public function setDate(DateTime $date)
    {
        $this->date = $date;
    }
    
    public function setFlag( $flag)
    {
            $flag = (int) $flag;
            $this->flag = $flag;
    }
 
//  GETTER //
    public function EpisodeId()
    {
        return $this->episodeId;
    }
 
    public function auteur()
    {
        return $this->auteur;
    }
 
    public function contenu()
    {
        return $this->contenu;
    }
 
    public function date()
    {
        return $this->date;
    }
    
    public function flag()
    {
        return $this->flag;
    }
}