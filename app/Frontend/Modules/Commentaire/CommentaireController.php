<?php
namespace App\Frontend\Modules\Commentaire;
use \Entity\Commentaire;
use \Form\FormBuilder\CommentFormBuilder;
use \BTFram\BackController;
use \BTFram\HTTPRequest;
use \Form\FormHandler;

class CommentaireController extends BackController
{
    // INSERT A COMMENT
    public function executeInsert(HTTPRequest $request)
    {
        $this->processForm($request);
        $this->page->addVar('titre', 'Ajout d\'un commentaire');
    }
    
    /*public function executeFlag(HTTPRequest $request)
    {
        $commentaireId = $request->getData('id');
        $commentaire = $this->managers->getManagerOf('Commentaire')->find($commentaireId);
        $flag = $commentaire['flag'];
        $flag ++;
        $this->managers->getManagerOf('Commentaire')->flagToComment($commentaireId, $flag);
        $this->app->user()->setFlash('Le commentaire a bien été signalé !');
        $this->app->httpResponse()->redirect('/');
    }*/
    
    public function processForm(HTTPRequest $request)
    {
        if ($request->method() == 'POST')
        {
            $commentaire = new Commentaire([
                'id_episode' => $request->getData('episodeId'),
                'auteur' => $request->postData('auteur'),
                'contenu' => $request->postData('contenu'),
                'flag' => $request->getData('flag'),
            ]);
            if ($request->getExists('episodeId')) {
                $commentaire->setId($request->getData('episodeId'));
            }
        }
            $commentaire = new Commentaire([
                'id_episode' => $request->getData('episodeId'),
//                'dateAjout' => time(),
                'flag' => 0,
            ]);
        $formBuilder = new CommentsFormBuilder($commentaire);
        $formBuilder->build();
        $form = $formBuilder->form();
        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Commentaire'), $request);
        if ($formHandler->process()) {
            $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !');
            $this->app->httpResponse()->redirect('/episode/episode-' . $request->getData('id') . '.html');
        }
        $this->page->addVar('commentaire', $commentaire);
        // On passe le formulaire généré a la vue
        $this->page->addVar('form', $form->createView());
    }
}