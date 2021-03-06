<?php

/**
* Class Controleur Episode / Frontend
* @param HTTPRequest $request
*/  
namespace App\Frontend\Modules\Episode;

use \BTFram\BackController;
use \BTFram\HTTPRequest;
use \Entity\Episode;
use \Form\FormHandler;
use \Form\FormBuilder\EpisodeFormBuilder;

class EpisodeController extends BackController
{
    
/**
* Action index Episode (page index: accueil)
* @param HTTPRequest $request
*/    
    public function executeIndex(HTTPRequest $request)
    {
        $nbEpisode = $this->app->config()->get('nb_episode');
        
        $nbCaractere = $this->app->config()->get('nb_caractere');
        // On ajoute une définition pour le titre.
        $this->page->addVar('titre', 'Accueil');
        // On récupère le manager des épisodes.
        $manager = $this->managers->getManagerOf('Episode');
        $listEpisode = $manager->getList(0, $nbEpisode);
        
        foreach ($listEpisode as $episode)
        {
            if (strlen($episode->contenu()) > $nbCaractere)
            {
                $debut = substr($episode->contenu(), 0, $nbCaractere);
                $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
                
                $episode->setContenu($debut);
            }
        }
        // On ajoute la variable $episodeList à la vue.
        $this->page->addVar('listEpisode', $listEpisode);
        
    }

/**
  * Action Show Episode (page show, detail episode)
  * @param HTTPRequest $request
  */
    public function executeShow(HTTPRequest $request)
    {
        $episode = $this->managers->getManagerOf('Episode')->getUnique($request->getData('id'));
        $commentaireId = $request->getData('id');
        if (empty($episode)) {
            $this->app->HttpResponse()->redirect404();
        }
        
        // // The variables are added to the view.
        $this->page->addVar('titre', $episode->titre());
        $this->page->addVar('episode', $episode);
        $this->page->addVar('commentaire', $this->managers->getManagerOf('Commentaire')->getListOf($episode->id()));
    }
    
/**
     * Action All Episode (page All, tous les episodes)
     * @param HTTPRequest $request
     */    
    public function executeAll(HTTPRequest $request)
    {
        $manager = $this->managers->getManagerOf('Episode');
        $listEpisode = $manager->getList();
        $nbEpisode = $manager->count();
        foreach ($listEpisode as $episode)
        {
            if (strlen($episode->contenu()) > 170)
            {
                $debut = substr($episode->contenu(), 0, 170);
                $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
                $episode->setContenu($debut);
            }
        }
        $this->page->addVar('titre', 'Tous les ' . $nbEpisode . ' épisodes');
        $this->page->addVar('nbEpisode', $nbEpisode);
        $this->page->addVar('listEpisode', $listEpisode);
    }
    
    /**
     * Action Last Episode (page last, les 5 derniers episodes)
     * @param HTTPRequest $request
     */
    public function executeLast(HTTPRequest $request)
    {
        $nbEpisode = $this->app->config()->get('nb_episode');
        $nbCaractere = $this->app->config()->get('nb_caractere');
        // On ajoute une définition pour le titre.
        $this->page->addVar('titre', 'Liste des ' . $nbEpisode . ' derniers épisodes');
        // On récupère le manager des épisodes.
        $manager = $this->managers->getManagerOf('Episode');
        $listEpisode = $manager->getList(0, $nbEpisode);
        
        foreach ($listEpisode as $episode)
        {
            if (strlen($episode->contenu()) > $nbCaractere)
            {
                $debut = substr($episode->contenu(), 0, $nbCaractere);
                $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
                $episode->setContenu($debut);
            }
        }
        // On ajoute la variable $episodeList à la vue.
        $this->page->addVar('listEpisode', $listEpisode);
        $this->page->addVar('nbEpisode', $nbEpisode);
    }
    
/**
     *  Action About (page About, A propos de l'auteur)
     * @param HTTPRequest $request
     */    
    public function executeAbout(HTTPRequest $request)
    {
        $this->page->addVar('titre', 'A propos');
    }

}