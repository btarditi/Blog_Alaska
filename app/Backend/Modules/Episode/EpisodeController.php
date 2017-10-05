<?php
namespace App\Backend\Modules\Episode;
 
use \BTFram\BackController;
use \BTFram\HTTPRequest;
use \Entity\Episode;
use \Form\FormHandler;
use \Form\FormBuilder\EpisodeFormBuilder;

class EpisodeController extends BackController
{
// ***ADMIN index Page****  
    public function executeAdmin(HTTPRequest $request)
    {
        if($this->app->user()->isAuthenticated()  && $this->app->user()->isAdmin())
        {
            $episodeManager = $this->managers->getManagerOf('Episode'); 
            $commentaireManager = $this->managers->getManagerOf('Commentaire');
            $userManager = $this->managers->getManagerOf('User');

            $this->page->addVar('titre', 'Gestion des episodes');
            $this->page->addVar('nbEpisode', $episodeManager->count());
            $this->page->addVar('listEpisode', $episodeManager->getList());
            $this->page->addVar('listCommentaire', $commentaireManager->getAll());
            $this->page->addVar('nbCommentaire', $commentaireManager->count());
            $this->page->addVar( 'nbCommentaireFlag', $commentaireManager->countCommentFlag() );
            $this->page->addVar('listUser', $userManager->getAll());
            $this->page->addVar('nbUser', $userManager->count());
        }
        else
        {
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
        if($request->getExists('id'))
        {
            $id = $request->getData('id');
            // SUppression de l'épisode demandé     
            $this->managers->getManagerOf('Episode')->delete($id);
            // Suppresion de tous les commentaires lié au chapitre a supprimer 
            $this->managers->getManagerOf('Commentaire')->deleteFromEpisode($id);
            $this->app->user()->setFlash('L\'épisode a bien été supprimé !');
            $this->app->httpResponse()->redirect('/admin/index.html');
        }
        else
        {
            $this->app->user()->setFlash('Aucun identifiant d\'épisode n\'a été transmis !');
        }
    }


    // Process Form //
    public function processFormEpisode( HTTPRequest $request )
    {
        if( $request->method() == 'POST' )
        {
            $episode = new Episode( [
                 'auteur' =>  'Jean Forteroche',
                 'titre' => $request->postData( 'titre' ),
                 'contenu' => $request->postData( 'contenu' ),
             ] );
            if( $request->getExists( 'id' ) )
            {
                $episode->setId( $request->getData( 'id' ) );
            }
        }
        else
        {
            if( $request->getExists( 'id' ) )
            {
                $episode = $this->managers->getManagerOf( 'Episode' )->getUnique( $request->getData( 'id' ) );
            }
            else
            {
                $episode = new Episode();
            }
        }
        
        $formBuilder = new EpisodeFormBuilder( $episode );
        $formBuilder->build();
        $form        = $formBuilder->form();
        $formHandler = new FormHandler( $form, $this->managers->getManagerOf( 'Episode' ), $request );
        
        if( $formHandler->process() ) {
            $this->app->user()->setFlash($episode->isNew() ? 'L\'épisode a bien été ajouté !' : 'L\'épisode a bien été modifié !' );
            $this->app->httpResponse()->redirect( '/admin/index.html' );
        }
        $this->page->addVar( 'episode', $episode );
        $this->page->addVar( 'form', $form->createView() );
    }
    
}