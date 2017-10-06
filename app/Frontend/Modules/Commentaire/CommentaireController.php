<?php
namespace App\Frontend\Modules\Commentaire;
use \Entity\Commentaire;
use \Form\FormBuilder\InsertCommentFormBuilder;
use \BTFram\BackController;
use \BTFram\HTTPRequest;
use \Form\FormHandler;

class CommentaireController extends BackController
{
    // Insertion d'un commentaire
    public function executeInsert(HTTPRequest $request)
    {
         if( $request->method() == 'POST' ) {
            $commentaire = new Commentaire([
                'episodeId' => $request->getData('id'),
                'auteur' => $request->postData('auteur'),
                'contenu' => $request->postData('contenu'),
            ]);
            if( $request->getExists( 'id' ) ) {
                $commentaire->setEpisodeId( $request->getData( 'id' ) );
            }
        }
        else
        {
            $commentaire = new Commentaire;
        }
        
        $formBuilder = new InsertCommentFormBuilder($commentaire);
        $formBuilder->build();
        $form = $formBuilder->form();
        
        $formHandler = new FormHandler( $form, $this->managers->getManagerOf('Commentaire'), $request);
        if($formHandler->process())
        {
            $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !' );
            $this->app->httpResponse()->redirect( '/episode/episode-'. $request->getData('id').'.html' );
        }
        
        // On passe les différentes variables à la vue
        $this->page->addVar( 'commentaire', $commentaire );
        $this->page->addVar( 'form', $form->createView() );
        $this->page->addVar( 'titre', 'Ajout d\'un commentaire à l\épisode' . $_GET['id'] );
    }
    
    // Ajout Flag a un commentaire
    public function executeFlag(HTTPRequest $request)
    {
        $commentaireId = $request->getData('id');
        $commentaire = $this->managers->getManagerOf('Commentaire')->getUnique($commentaireId);
        
        $flag = $commentaire['flag'];
        $flag ++;
        
        $commentaire->setFlag($flag);
        
        $this->managers->getManagerOf('Commentaire')->save($commentaire);
        
        $this->app->user()->setFlash('Le commentaire a bien été signalé !');
        $this->app->httpResponse()->redirect( '/episode/episode-'.$commentaire->episodeId() .'.html' );
    }
    
    
}