<?php
namespace App\Frontend\Modules\Episode;
use \BTFram\BackController;
use \BTFram\HTTPRequest;
use \Entity\Commentaire;
use \BTFram\Form;
use \BTFram\StringField;
use \BTFram\TextField;

class EpisodeController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $nbEpisode = $this->app->config()->get('nb_episode');
        $nbCaracteres = $this->app->config()->get('nombre_caracteres');
        
        // On ajoute une définition pour le titre.
        $this->page->addVar('titre', 'Liste des ' . $nbEpisode . ' derniers épisodes');
        
        // On récupère le manager des épisodes.
        $manager = $this->managers->getManagerOf('Episode');
        $episodeList = $manager->getList(0, $nbEpisode);
        
        foreach ($episodeList as $episode)
        {
            if (strlen($episode->Content()) > $nbCaracteres)
            {
                $debut = substr($episode->Content(), 0, $nbCaracteres);
                $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
                $episode->setContent($debut);
            }
        }
        // On ajoute la variable $episodeList à la vue.
        $this->page->addVar('episodeList', $episodeList);
    }
    
    public function executeShow(HTTPRequest $request)
    {
        $episode = $this->managers->getManagerOf('Episode')->getUnique($request->getData('id'));
        if (empty($episode)) {
            $this->app->HttpResponse()->redirect404();
        }
        $this->page->addVar('titre', $episode->getTitre());
        $this->page->addVar('episode', $episode);
        $this->page->addVar('Commentaire', $this->managers->getManagerOf('Commentaire')->getListOf($episode->Id()));
    }
    
    public function executeInsertComment(HTTPRequest $request)
    {
        // Si le formulaire a été envoyé, on crée le commentaire avec les valeurs du formulaire
        if($request->method() == 'POST'){
            $comment = new Commentaire([
                 'id_episode' => $request->getData('id_episode'),
                 'auteur' => $request->getData('auteur'),
                 'contenu' => $request->getData('contenu')
            ]);
            } else {
                $comment = new Commentaire;
            }
            
        $form = new Form($comment);
 
        $form->add(new StringField([
            'label' => 'Auteur',
            'name' => 'auteur',
            'maxLength' => 50
            ]))->add(new TextField([
            'label' => 'Contenu',
            'name' => 'contenu',
            'rows' => 7,
            'cols' => 50
             ]));
        
        if ($form->isValid())
        {
            // On enregistre le commentaire
        }
        $this->page->addVar('commentaire', $comment);
        
        // On passe le formulaire généré a la vue
        $this->page->addVar('form', $form->createView());
        $this->page->addVar('title', 'Ajout d\'un commentaire');
    }

    public function executeDelete(HTTPRequest $request)
    {
        $id_episode = $request->getData('id');
        $this->managers->getManagerOf('Episode')->delete($chaptersId);
        $this->managers->getManagerOf('Commentaire')->deleteFromChapter($chaptersId);
        $this->app->user()->setFlash('L\'épisode a bien été supprimé !');
        $this->app->httpResponse()->redirect('.');
    }
}