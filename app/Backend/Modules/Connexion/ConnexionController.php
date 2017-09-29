<?php
namespace App\Backend\Modules\Connexion;

use \BTFram\BackController;
use \BTFram\HTTPRequest;
use \Entity\User;
use \Form\FormBuilder\ConnectFormBuilder;

class ConnexionController extends BackController
{
    /**
     * LogIn the user with the Username and Password
     * @param HTTPRequest $request
     */
    public function executeLogin(HTTPRequest $request)
    {
        $this->page->addVar('titre', 'Connexion  utilisateur');
        $this->processFormLogin($request);
    }
    /**
     * Log Out and Redirect the user of the Home Page
     * @param HTTPRequest $request
     */
    public function executeLogout(HTTPRequest $request)
    {
        $this->app->user()->setAuthenticated(false);
        $this->app->httpResponse()->redirect('/');
        $this->app->user()->setFlash('Au revoir, à bientôt !');
    }

    public function processFormLogin( HTTPRequest $request )
    {
        if( $request->method() == 'POST' )
        {
            $user = new User( [
                'username' => $request->postData( 'username' ),
                'password' => $request->postData( 'password' ),
                'email' => $request->postData( 'email' ),
            ] );
            // On récupère l'utilisateur en BDD
            $userBDD = $this->managers->getManagerOf('User')->getByUsername($request->postData('username'));
            if(!empty($userBDD))
            {
                // On récupère la clé de salage en BDD
                $salt = $userBDD['salt'];
                // On récupère le hashage en BDD
                $hash = $userBDD['password'];
                // On récupère le mdp du formulaire de connexion
                $pass = $request->postData('password');
                if($hash == sha1($pass . $salt))
                {
                    $user = $userBDD;
                    $this->app->user()->setAuthenticated(true);
                    $_SESSION['role'] = $userBDD->role();
                    $this->app->user()->setFlash('Connexion établie, bonne lecture !');
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
            $user = new User();
        }
        $formBuilder = new ConnectFormBuilder($user);
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