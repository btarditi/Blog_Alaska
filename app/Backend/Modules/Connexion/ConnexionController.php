<?php
namespace App\Backend\Modules\Connexion;

use \BTFram\BackController;
use \BTFram\HTTPRequest;
use \Form\FormBuilder\RegisterFormBuilder;
use \Entity\User;

class ConnexionController extends BackController
{
    /**
     * LogIn the user with the Username and Password
     * @param HTTPRequest $request
     */
    public function executeLogin(HTTPRequest $request)
    {
        $this->page->addVar('titre', 'Connexion  utilisateur');
        $this->processFormConnect($request);
    }
    /**
     * Log Out and Redirect the user of the Home Page
     * @param HTTPRequest $request
     */
    public function executeLogout(HTTPRequest $request)
    {
        $this->app->user()->setAuthenticated(false);
        $_SESSION['role'] = '';
        $this->app->httpResponse()->redirect('/');
        $this->app->user()->setFlash('Aurevoir, à bientôt !');
    }

    public function processFormConnect( HTTPRequest $request )
    {
        if( $request->method() == 'POST' ) {
            $user = new User( [
               'username' => $request->postData( 'username' ),
               'password' => $request->postData( 'password' ),
           ] );
//            if( $request->getExists( 'id' ) ) {
//                $user->setId( $request->getData( 'id' ) );
//            }
            if( $request->postData('username') === 'admin' ) {
                $user->setRole( 'ROLE_ADMIN' );
            }
            else {
                $user->setRole('ROLE_USER');
            }
            // On récupère l'utilisateur en BDD
            $userBDD = $this->managers->getManagerOf('User')->getByUsername($user->username());
            if(!empty($userBDD)) {
                if($user->username() == $userBDD->username())
                {
//                    $salt = $userBDD->salt();
//                    $pass = substr(sha1($user->password() . $salt), 0,23);
                    $pass = $request->postData('password');
                    if($pass == $userBDD['password'])
                    {
                        $this->app->user()->setAuthenticated(true);
                        $_SESSION['role'] = $user->role();
                        $this->app->httpResponse()->redirect('/');
                    }
                    else
                    {
                        $erreurs = 'Votre mot de passe ne correspond pas!';
                    }
                }
                else
                {
                    $erreurs = 'Votre nom d\'utilisateur est incorrect !';
                }
            }
            else
            {
                $erreurs = 'Vous n\'êtes pas encore inscrit, procéder à votre inscription !';
            }
        }
        else
        {
            $user = new User();
        }
        $formBuilder = new RegisterFormBuilder($user);
        $formBuilder->build();
        $form = $formBuilder->form();
        // Si une erreur a été générer, on l'envoie à la page
        if(isset($erreurs)) {
            $this->page->addVar( 'erreurs', $erreurs );
        }
        // On envoie le formulaire à la page
        $this->page->addVar('form', $form->createView());
    }
}