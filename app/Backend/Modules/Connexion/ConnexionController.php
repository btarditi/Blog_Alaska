<?php
namespace App\Backend\Modules\Connexion;

use \BTFram\BackController;
use \BTFram\HTTPRequest;
use \Entity\User;
use \Form\FormHandler;
use \Form\FormBuilder\ConnectFormBuilder;
use \Form\FormBuilder\RegisterFormBuilder;

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

    public function executeAddUser(HTTPRequest $request)
    {       
        $this->page->addVar('titre', 'Inscrivez vous');
        $this->processFormRegister($request);
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
        
        if(!empty($user)) {
            $this->page->addVar('user', $user);
        }
        // On envoie le formulaire à la page
        $this->page->addVar('form', $form->createView());
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
            $userBDD = $this->managers->getManagerOf('User')->getByUsername($request->postData('username'));
            $username = $request->postData('username');
            if(empty($userBDD) && isset($username)) // Si le username n'existe pas en BDD
            {
                if($user->isNew())
                {
                    // On force le role utilisateur à USER
                    $user->setRole('USER');
                    // On génère une clé de salage
                    $user->setSalt(substr(md5(time()), 0, 23));
                }

                $mdpForm = $request->postData('password');

                if(isset($mdpForm) && !empty($mdpForm))
                {
                    $pass = sha1($mdpForm . $user->salt());
                    $user->setPassword($pass);
                }
                else
                {
                    $erreurs = 'Veuillez entrez un mot de passe valide !';
                    $this->app->httpResponse()->redirect( '/admin/user-insert.html' );
                }
            }
            if($request->getExists('id')){
                $user->setId ( $request->getData('id'));
                $user->setUsername($request->postData('username'));
                $user->setemail($request->postData('email'));
                $user->setPassword($request->postData('password'));
                $user->setRole('USER');
                //$user->setInscription('inscription');
            }
            
        }
        else
        {
            $user = new User();
        }
     
        $formBuilder = new RegisterFormBuilder($user);
        $formBuilder->build();
        $form = $formBuilder->form();

        $formHandler = new FormHandler($form, $this->managers->getManagerOf('User'), $request);

        if ($formHandler->process())
        {
            $this->app->user()->setFlash($user->isNew() ? 'L\'utilisateur à bien été ajouté !' : 'L\'utilisateur Existe déja !');

            $user->isNew() ? $this->app->httpResponse()->redirect('/admin/connect.html') : $this->app->httpResponse()->redirect('/');
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