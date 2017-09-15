<?php
namespace App\Backend\Modules\Episode;
 
use \BTFram\BackController;
use \BTFram\Entity;
use \BTFram\HTTPRequest;
use \Entity\Episode;
use \Entity\Commentaire;
use \Entity\Users;
use \Form\Form;
use \Form\FormBuilder;
use \Form\FormHandler;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\EpisodeFormBuilder;
use \Form\FormBuilder\RegisterFormBuilder;


 
class EpisodeController extends BackController
{
// ADMIN Home Page  
  public function executeAdmin(HTTPRequest $request)
  {
    if ($this->app->user()->isAuthenticated() && $this->app->user()->isAdmin())
        {
            $episodeManager = $this->managers->getManagerOf('Episode');
            $commentaireManager = $this->managers->getManagerOf('Commentaire');
            $userManager = $this->managers->getManagerOf('Users');
            $this->page->addVar('titre', 'Gestion des épisodes');
            $this->page->addVar('nbepisode', $episodeManager->count());
            $this->page->addVar('episodesList', $episodeManager->getList());
            $this->page->addVar('commentsList', $commentManager->findAll());
            $this->page->addVar('nbComments', $commentManager->count());
            $this->page->addVar('nbCommentsFlag', $commentManager->countCommentFlag());
            $this->page->addVar('usersList', $userManager->findAll());
            $this->page->addVar('nbUsers', $userManager->count());
        }
        else {
            $this->app->user()->setFlash('Désolé, vous n\'avez pas d\'autorisation pour accéder à l\'espace d\'administration');
        }
  }

// Episode //
// INSERT A episode    
  public function executeInsert(HTTPRequest $request)
  {
    $this->processFormEpisode($request);
     
    $this->page->addVar('titre', 'Ajout d\'un épisode');
  }
// UPDATE A CHAPTER 
  public function executeUpdate(HTTPRequest $request)
  {
    $this->processFormEpisode($request);
     
    $this->page->addVar('titre', 'Modification d\'un épisode');
  }

// DELETE A CHAPTER    
  public function executeDelete(HTTPRequest $request)
  {
    $chapterId = $request->getData('id');
// SUppression de l'épisode demandé     
    $this->managers->getManagerOf('Episode')->delete($episodeId);
    $this->app->user()->setFlash('L\'épisode a bien été supprimé !');
    
// Suppresion de tous les commentaires lié au chapitre a supprimer 
    $this->managers->getManagerOf('Commentaire')->deleteAllByEpisode($chapterId);
      
    
    $this->app->httpResponse()->redirect('.');
  }

// COMMENT //
// UPDATE A COMMENT //
  public function executeUpdateComment(HTTPRequest $request)
  {
    $redirect = '/episode-'. $request->getData('id');
        $this->processFormComment($request, $redirect);
        $this->page->addVar('titre', 'Modification d\'un commentaire');  
  }
// DELETE A COMMENT    
  public function executeDeleteComment(HTTPRequest $request)
  {
    $this->managers->getManagerOf('Commentaire')->delete($request->getData('id'));
 
    $this->app->user()->setFlash('Le commentaire a bien été supprimé !');
 
    $this->app->httpResponse()->redirect('.');
  }
 
// USERS //
    
  public function executeUserInsert(HTTPRequest $request)
    {
        $this->processFormUser($request);
        $this->page->addVar('titre', 'Ajout d\'un utilisateur');
    }
    public function executeUserUpdate(HTTPRequest $request)
    {
        $this->processFormUser($request);
        $this->page->addVar('titre', 'Modification d\'un utilisateur');
    }
    public function executeUserDelete(HTTPRequest $request)
    {
        $userManager = $this->managers->getManagerOf('Users');
        $commentManager = $this->managers->getManagerOf('Commentaire');
        $commentManager->deleteAllByUser($request->getData('id'));
        $userManager->delete($request->getData('id'));
        $this->app->user()->setFlash('L\'utilisateur et ses commentaires à bien été supprimer.');
        // redirection vers l'Admin
        $this->app->httpResponse()->redirect('/admin/');
    }
            // All Process Form //
    public function processFormChapter(HTTPRequest $request)
    {
        if ($request->method() == 'POST')
            {
            $episode = new Episode([
                'id' => $request->getData('id'),
                'auteur' => $request->postData('auteur'),
                'titre' => $request->postData('titre'),
                'contenu' => $request->postData('contenu')
            ]);
            if ($request->getExists('id'))
                {
                $chapter->setId($request->getData('id'));
            }
        }
        else
            {
            // L'identifiant du episode est transmis si on veut la modifier
            if ($request->getExists('id'))
                {
                $chapter = $this->managers->getManagerOf('Episode')->find($request->getData('id'));
            }
            else
                {
                $episode = new Episode();
            }
        }
        $formBuilder = new EpisodeFormBuilder($episode);
        $formBuilder->build();
        $form = $formBuilder->form();
        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Episode'), $request);
        if ($formHandler->process())
            {
            $this->app->user()->setFlash($episode->isNew() ? 'L\'épisode a bien été ajouté !' : 'L\'épisode a bien été modifié !');
            $this->app->httpResponse()->redirect('/admin/');
        }
        $this->page->addVar('form', $form->createView());
    }
    public function processFormComment(HTTPRequest $request, $redirect)
    {
        if ($request->method() == 'POST') {
            $comment = new Commentaire([
                'id_episode' => $request->postData('episode'),
                'auteur' => $request->postData('auteur'),
                'contenu' => $request->postData('contenu'),
//                'dateAjout' => $request->postData('dateAjout'),
                'flag' => $request->postData('flag')
            ]);
            if ($request->getExists('id')) {
                $comment->setId($request->getData('id'));
            }
        }
        else {
            // The identifier of the episode is transmitted if we want to modify it
            if ($request->getExists('id')) {
                $comment = $this->managers->getManagerOf('Commentaire')->find($request->getData('id'));
            }
            else {
                $comment = new Commentaire();
            }
        }
        $formBuilder = new CommentsFormBuilder($comment);
        $formBuilder->build();
        $form = $formBuilder->form();
        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Commentaire'), $request);
        if ($formHandler->process()) {
            $this->app->user()->setFlash($comment->isNew() ? 'Le commentaire a bien été ajouté, merci !' : 'Le commentaire a bien été modifié, merci !');
            $this->app->httpResponse()->redirect($redirect);
        }
        $this->page->addVar('comment', $comment);
        // On passe le formulaire généré a la vue
        $this->page->addVar('form', $form->createView());
    }
}