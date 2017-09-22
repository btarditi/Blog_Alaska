<?php
namespace App\Backend\Modules\Episode;
 
use \BTFram\BackController;
use \BTFram\HTTPRequest;
use \Entity\Episode;
use \Form\FormBuilder\EpisodeFormBuilder;
use \Form\FormHandler;

class EpisodeController extends BackController
{
// ***ADMIN index Page****  
    public function executeIndex(HTTPRequest $request)
    {
        
       if($this->app->user()->isAuthenticated()){
            $this->page->addVar('titre', 'Gestion des episodes');
           
            $episodeManager = $this->managers->getManagerOf('Episode');
            $commentaireManager = $this->managers->getManagerOf('Commentaire');
            $userManager = $this->managers->getManagerOf('User');
           
            $this->page->addVar('nbEpisode', $episodeManager->count());
            $this->page->addVar('listEpisode', $episodeManager->getList());
            $this->page->addVar('listCommentaire', $commentaireManager->getAll());
            $this->page->addVar('nbCommentaire', $commentaireManager->count());
            $this->page->addVar('listUser', $userManager->getAll());
            $this->page->addVar('nbUser', $userManager->count());
    }
        else {
            $this->app->user()->setFlash('Désolé, vous n\'avez pas l\accréditaion nécessaire pour accéder à l\'espace d\'administration');
        }
    
    
    
    }    
  
/* 
Episode
*/
// INSERT A EPISODE    
    public function executeInsert(HTTPRequest $request)
    {
        $this->processFormEpisode($request);
        $this->page->addVar('titre', 'Ajout d\'un épisode');
    }
    
// UPDATE A EPISODE 
    public function executeUpdate(HTTPRequest $request)
    {
        $this->processFormEpisode($request);
        $this->page->addVar('titre', 'Modification d\'un épisode');
    }

// DELETE A EPISODE    
    public function executeDelete(HTTPRequest $request)
    {
        $episodeId = $request->getData('id');
// SUppression de l'épisode demandé     
        $this->managers->getManagerOf('Episode')->delete($episodeId);
// Suppresion de tous les commentaires lié au chapitre a supprimer 
        $this->managers->getManagerOf('Commentaire')->deleteFromEpisode($chapterId);
        $this->app->user()->setFlash('L\'épisode a bien été supprimé !');
        $this->app->httpResponse()->redirect('/admin/');
    }


            // All Process Form //
    public function processFormEpisode(HTTPRequest $request)
    {
        if ($request->method() == 'POST')
        {
            $episode = new Episode([
                'auteur' => $request->postData('auteur'),
                'titre' => $request->postData('titre'),
                'contenu' => $request->postData('contenu')
            ]);
            if ($request->postExists('id'))
            {
                $episode->setId($request->postData('id'));
            }
        }
        else
        {
// L'identifiant de la news est transmis si on veut la modifier
            if ($episode->getExists('id'))
            {
                $episode = $this->managers->getManagerOf('Episode')->getUnique($request->getData('id'));
            }
            else
            {
                $episode = new Episode;
            }
        }
        $formBuilder = new episodeFormBuilder($episode);
        $formBuilder->build();
 
        $form = $formBuilder->form();
 
        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Episode'), $request);
 
        if ($formHandler->process())
        {
            $this->app->user()->setFlash($episode->isNew() ? 'L\'épisode a bien été ajouté !' : 'L\'épisode a bien été modifié !');
 
            $this->app->httpResponse()->redirect('/admin/index.html');
        }
 
        $this->page->addVar('form', $form->createView());
    }
    
}