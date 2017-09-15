<?php
namespace App\Backend\Modules\Episode;
 
use \BTFram\BackController;
use \BTFram\HTTPRequest;
use Entity\Commentaire;

 
class EpisodeController extends BackController
{
  
  public function executeIndex(HTTPRequest $request)
  {
    $this->page->addVar('titre', 'Gestion des épisodes');
 
    $manager = $this->managers->getManagerOf('Episode');
 
    $this->page->addVar('listEpisode', $manager->getList());
    $this->page->addVar('nombreEpisode', $manager->count());
  }
 
  public function executeInsert(HTTPRequest $request)
  {
    if ($request->postExists('auteur'))
    {
      $this->processForm($request);
    }
 
    $this->page->addVar('titre', 'Ajout d\'un épisode');
  }
 
  public function executeUpdate(HTTPRequest $request)
  {
    if ($request->postExists('auteur'))
    {
      $this->processForm($request);
    }
    else
    {
      $this->page->addVar('episode', $this->managers->getManagerOf('Episode')->getUnique($request->getData('id')));
    }
 
    $this->page->addVar('titre', 'Modification d\'un épisode');
  }
    
  public function executeDelete(HTTPRequest $request)
  {
    $chapterId = $request->getData('id');
      
    $this->managers->getManagerOf('Episode')->delete($request->getData('id'));
     
    $this->app->user()->setFlash('L\'épisode a bien été supprimée !');
 
    $this->app->httpResponse()->redirect('.');
  }
 
  public function executeUpdateComment(HTTPRequest $request)
  {
    $this->page->addVar('titre', 'Modification d\'un commentaire');
 
    if ($request->postExists('pseudo'))
    {
      $comment = new Commentaire([
        'id' => $request->getData('id'),
        'auteur' => $request->postData('pseudo'),
        'contenu' => $request->postData('contenu')
      ]);
 
      if ($comment->isValid())
      {
        $this->managers->getManagerOf('Commentaire')->save($comment);
 
        $this->app->user()->setFlash('Le commentaire a bien été modifié !');
 
        $this->app->httpResponse()->redirect('/episode-'.$request->postData('episode').'.html');
      }
      else
      {
        $this->page->addVar('erreurs', $comment->erreurs());
      }
 
      $this->page->addVar('comment', $comment);
    }
    else
    {
      $this->page->addVar('comment', $this->managers->getManagerOf('Commentaire')->get($request->getData('id')));
    }
  }
    
  public function executeDeleteComment(HTTPRequest $request)
  {
    $this->managers->getManagerOf('Commentaire')->delete($request->getData('id'));
 
    $this->app->user()->setFlash('Le commentaire a bien été supprimé !');
 
    $this->app->httpResponse()->redirect('.');
  }
 
  public function processForm(HTTPRequest $request)
  {
    $episode = new Episode([
      'auteur' => $request->postData('auteur'),
      'titre' => $request->postData('titre'),
      'contenu' => $request->postData('contenu')
    ]);
 
    // L'identifiant de la news est transmis si on veut la modifier.
    if ($request->postExists('id'))
    {
      $episode->setId($request->postData('id'));
    }
 
    if ($episode->isValid())
    {
      $this->managers->getManagerOf('Episode')->save($episode);
 
      $this->app->user()->setFlash($episode->isNew() ? 'L\'épisode a bien été ajoutée !' : 'L\'épisode a bien été modifiée !');
    }
    else
    {
      $this->page->addVar('erreurs', $episode->erreurs());
    }
 
    $this->page->addVar('episode', $episode);
  }
}