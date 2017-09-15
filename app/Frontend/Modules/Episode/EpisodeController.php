<?php
namespace App\Frontend\Modules\Episode;
use \BTFram\BackController;
use \BTFram\HTTPRequest;
use \Entity\Episode;
use \FormBuilder\EpisodeFormBuilder;
use \BTFram\FormHandler;

class EpisodeController extends BackController
{
    
/**
* Home Page Controller
* @param HTTPRequest $request
*/    
    public function executeHome(HTTPRequest $request)
    {
        $nbEpisode = $this->app->config()->get('nb_episode');
        $nbCaractere = $this->app->config()->get('nb_caractere');
        // On ajoute une définition pour le titre.
        $this->page->addVar('titre', 'Liste des ' . $nbEpisode . ' derniers épisodes');
        // On récupère le manager des épisodes.
        $manager = $this->managers->getManagerOf('Episode');
        $episodeList = $manager->getList(0, $nbEpisode);
        
        foreach ($episodeList as $episode)
        {
            if (strlen($episode->content()) > $nbCaractere)
            {
                $debut = substr($episode->content(), 0, $nbCaractere);
                $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
                $episode->setContent($debut);
            }
        }
        // On ajoute la variable $episodeList à la vue.
        $this->page->addVar('episodeList', $episodeList);
    }

/**
*  About page controller
* @param HTTPRequest $request
*/
    public function executeAbout(HTTPRequest $request)
    {
        $this->page->addVar('titre', 'A propos');
    }
    
/**
* One Chapter Page controller
* @param HTTPRequest $request
*/    
    public function executeShow(HTTPRequest $request)
    {
        $episode = $this->managers->getManagerOf('Episode')->find($request->getData('id'));
        $commentId = $request->getData('id');
        
        if (empty($episode)) {
            $this->app->HttpResponse()->redirect404();
        }
        
        // // The variables are added to the view.
        $this->page->addVar('titre', $episode->titre());
        $this->page->addVar('episode', $episode);
        $this->page->addVar('commentId', $commentId);
        $this->page->addVar('comment', $this->managers->getManagerOf('Commentaire')->getListOf($episode->id()));
    }
    
/**
* List of last 5 Chapters
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
        $episodeList = $manager->getList(0, $nbEpisode);
        foreach ($episodeList as $episode) {
            if (strlen($episode->content()) > $nbCaractere) {
                $debut = substr($episode->content(), 0, $nbCaractere);
                $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
                $episode->setContent($debut);
            }
        }
        $this->page->addVar('episodeList', $episodeList);
        $this->page->addVar('nbEpisode', $nbEpisode);
    }

/**
* List of ALL chapters
* @param HTTPRequest $request
*/
    public function executeAll(HTTPRequest $request)
    {
        $manager = $this->managers->getManagerOf('Episode');
        $episodeList = $manager->findAll();
        $nbEpisode = $manager->count();
        foreach ($episodeList as $episode)
        {
            if (strlen($episode->content()) > 170)
            {
                $debut = substr($episode->content(), 0, 170);
                $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
                $episode->setContent($debut);
            }
        }
        $this->page->addVar('titre', 'Tous les ' . $nbepisode . ' épisodes');
        $this->page->addVar('nbEpisode', $nbEpisode);
        $this->page->addVar('episodeList', $episodeList);
    }
    
    
    
    /*public function executeFlagComment(HTTPRequest $request)
    {
        $commentId = $request->getData('id');
        $comment = $this->managers->getManagerOf('Commentaire')->find($commentId);
        $flag = $comment['flag'];
        $flag ++;
        $this->managers->getManagerOf('Commentaire')->flagToComment($commentId, $flag);
        $this->app->user()->setFlash('Le commentaire a bien été signalé !');
        $this->app->httpResponse()->redirect('.');
    }
    
    public function processForm(HTTPRequest $request)
    {
        if ($request->method() == 'POST') {
            $comment = new Commentaire([
                'episode' => $request->postData('episode'),
                'auteur' => $request->postData('auteur'),
                'contenu' => $request->postData(strip_tags('contenu')),
//                'dateCreate' => $request->getData('dateCreate'),
                'flag' => $request->getData('flag')
            ]);
            if ($request->getExists('id')) {
                $comment->setId($request->getData('id'));
            }
        } else {
            // The identifier of the chapter is transmitted if we want to modify it
            if ($request->getExists('id')) {
                $comment = $this->managers->getManagerOf('Commentaire')->find($request->getData('id'));
            } else {
                $comment = new Commentaire([
                    'episode' => $request->getData('id'),
                    'flag' => $request->postData('flag'),
                ]);
            }
        }
        $formBuilder = new CommentFormBuilder($comment);
        $formBuilder->build();
        $form = $formBuilder->form();
        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Commentaire'), $request);
        if ($formHandler->process()) {
            $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !');
            $this->app->httpResponse()->redirect('episode-' . $request->postData('episode') . '.html');
        }
        $this->page->addVar('comment', $comment);
        // On passe le formulaire généré a la vue
        $this->page->addVar('form', $form->createView());
    }*/
}