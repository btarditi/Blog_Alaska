<?php

namespace App\Backend\Modules\User;

use \Log4php;
use \Entity\User;
use \BTFram\BackController;
use \BTFram\HTTPRequest;
use \Form\FormHandler;
use \Form\FormBuilder\UserFormBuilder;
use \Form\FormBuilder\RegisterFormBuilder;


class UserController extends BackController
{
    // USERS //
    public function executeInsert(HTTPRequest $request)
    {
        $this->processFormRegister($request);
        $this->page->addVar('titre', 'Ajout d\'un utilisateur');
    }
    public function executeUpdate(HTTPRequest $request)
    {
        $this->processFormRegister($request);
        $this->page->addVar('titre', 'Modification d\'un utilisateur');
    }
    public function executeDelete(HTTPRequest $request)
    {
        $this->managers->getManagerOf('User')->delete($request->getData('id'));
        $this->app->user()->setFlash('L\'utilisateur et ses commentaires ont bien été supprimer.');
        // redirection vers l'Admin
        $this->app->httpResponse()->redirect('/admin/index.html');
    }
    public function executeSwitchRole(HTTPRequest $request)
    {
        $manager = $this->managers->getManagerOf('User');
        if($request->getExists('id'))
        {
            $manager->switchUserRole($request->getData('id'));
            $this->app()->httpResponse()->redirect('/admin/index.html');
        }
        else
        {
            $this->app->user()->setFlash('Aucun identifiant n\'a été transmis !!!');
            $this->app->httpResponse()->redirect404();
        }
        if($_SESSION['role'] == 'USER')
        {
            $_SESSION['role'] = 'ADMIN';
        }
        elseif($_SESSION['role'] == 'ADMIN')
        {
            $_SESSION['role'] = 'USER';
        }
    }
    public function processFormRegister(HTTPRequest $request)
    {
        if( $request->method() == 'POST' )
        {
            $user = new User( array(
               'username' => $request->postData( 'username' ),
               'password' => $request->postData( 'password'),
               'email' => $request->postData( 'email'),
           ));
            
            if( $request->getExists( 'id' ) )
            {
                $user->setId ( $request->getData('id'));
            }
        }
        else
        {
            if( $request->getExists( 'id' ) )
            {
                $user = $this->managers->getManagerOf( 'User' )->getUnique( $request->getData( 'id' ) );
            }
            else
            {
                $user = new User();
            }
        }
     
        $formBuilder = new RegisterFormBuilder($user);
        $formBuilder->build();
        $form = $formBuilder->form();

        $formHandler = new FormHandler($form, $this->managers->getManagerOf('User'), $request);

        if ($formHandler->process())
        {
            $this->app->user()->setFlash($user->isNew() ? 'L\'utilisateur à bien été ajouté !' : 'L\'utilisateur à bien été modifié !');

            $user->isNew() ? $this->app->httpResponse()->redirect('/') : $this->app->httpResponse()->redirect('/admin/index.html#user');
        }
        
        // Si une erreur a été générer, on l'envoie à la page
        if(isset($erreurs))
        {
            $this->page->addVar( 'erreurs', $erreurs );
        }

        // On envoie le formulaire à la page
        $this->page->addVar('form', $form->createView());


    } /* End of ProcessFormUser */
    
}
    

