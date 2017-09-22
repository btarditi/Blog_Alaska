<?php
namespace App\Backend\Modules\Commentaire;
use \Entity\Commentaire;
use \Form\FormBuilder\CommentFormBuilder;
use \BTFram\BackController;
use \BTFram\HTTPRequest;
use \Form\FormHandler;

class CommentaireController extends BackController
{
    // UPDATE A COMMENT //
    public function executeUpdate(HTTPRequest $request)
    {

        $this->processForm($request);
        $this->page->addVar('titre', 'Modification d\'un commentaire');
    }
    // DELETE A COMMENT
    public function executeDelete(HTTPRequest $request)
    {
        $this->managers->getManagerOf('Commentaire')->delete($request->getData('id'));
        $this->app->user()->setFlash('Le commentaire a bien été supprimé !');
        $this->app->httpResponse()->redirect('/admin/index.html');
    }
    // FORM HANDLER//
    public function processForm(HTTPRequest $request)
    {
        if ($request->method() == 'POST')
        {
            $commentaire = new Commentaire([
                'id' => $request->getData('id'),
                'auteur' => $request->postData('auteur'),
                'contenu' => $request->postData('contenu'),
                'flag' => $request->postData('flag'),
            ]);
            if ($request->getExists('id'))
            {
                $commentaire->setId($request->getData('id'));
            }
        }
        else
        {
            // L'identifiant de l'épisode est transmis si on veut la modifier
            if ($request->getExists('id'))
            {
                $commentaire = $this->managers->getManagerOf('Commentaire')->getUnique($request->getData('id'));
            }
            else
            {
                $commentaire = new Commentaire();
            }
        }
        $formBuilder = new CommentFormBuilder($commentaire);
        $formBuilder->build();
        $form = $formBuilder->form();
        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Commentaire'), $request);
        if ($formHandler->process()) {
            $this->app->user()->setFlash($commentaire->isNew() ? 'Le commentaire a bien été ajouté !' : 'Le commentaire a bien été modifié !');
            $this->app->httpResponse()->redirect('/admin/index.html');
        }
        $this->page->addVar('commentaire', $commentaire);
        // On passe le formulaire généré a la vue
        $this->page->addVar('form', $form->createView());
    }
}