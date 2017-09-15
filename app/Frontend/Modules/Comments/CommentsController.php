<?php
namespace App\Frontend\Modules\Comments;
use \Entity\Commentaire;
use \Form\FormBuilder\CommentsFormBuilder;
use \BTFram\BackController;
use \BTFram\HTTPRequest;
use \Form\FormHandler;

class CommentsController extends BackController
{
    // INSERT A COMMENT
    public function executeInsert(HTTPRequest $request)
    {
        $this->processForm($request);
        $this->page->addVar('titre', 'Ajout d\'un commentaire');
    }
    public function executeFlag(HTTPRequest $request)
    {
        $commentId = $request->getData('id');
        $comment = $this->managers->getManagerOf('Commentaire')->find($commentId);
        $flag = $comment['flag'];
        $flag ++;
        $this->managers->getManagerOf('Commentaire')->flagToComment($commentId, $flag);
        $this->app->user()->setFlash('Le commentaire a bien été signalé !');
        $this->app->httpResponse()->redirect('/');
    }
    public function processForm(HTTPRequest $request)
    {
        if ($request->method() == 'POST')
        {
            $comment = new Commentaire([
                'episode' => $request->getData('episodeId'),
                'auteur' => $request->postData('auteur'),
                'contenu' => $request->postData('contenu'),
                'flag' => $request->getData('flag'),
            ]);
            if ($request->getExists('episodeId')) {
                $comment->setId($request->getData('episodeId'));
            }
        }
            $comment = new Commentaire([
                'episode' => $request->getData('episodeId'),
//                'dateAjout' => time(),
                'flag' => 0,
            ]);
        $formBuilder = new CommentsFormBuilder($comment);
        $formBuilder->build();
        $form = $formBuilder->form();
        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Commentaire'), $request);
        if ($formHandler->process()) {
            $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !');
            $this->app->httpResponse()->redirect('/episode-' . $request->getData('episodeId') . '.html');
        }
        $this->page->addVar('comment', $comment);
        // On passe le formulaire généré a la vue
        $this->page->addVar('form', $form->createView());
    }
}