<?php
namespace App\Backend\Modules\Connexion;

use \BTFram\BackController;
use \BTFram\HTTPRequest;
use \Form\FormBuilder\RegisterFormBuilder;
use \Entity\User;
use \Form\FormHandler;

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
        $this->app->httpResponse()->redirect('/');
        $this->app->user()->setFlash('Aurevoir, à bientôt !');
    }

    public function processFormConnect( HTTPRequest $request )
    {
        if( $request->method() == 'POST' )
        {
            $user = new User( [
               'username' => $request->postData( 'username' ),
               'password' => $request->postData( 'password' ),
               'salt' => $request->postData('salt')
            ] );
            if( $request->getExists( 'id' ) )
            {
                $user->setId( $request->getData( 'id' ) );
            }
        }
        else
        {
            // L'identifiant de l'utilisateur est transmis si on veut la modifier
            if ($request->getExists('id'))
            {
                $user = $this->managers->getManagerOf('User')->getUnique($request->getData('id'));    
            }
            else
            {
                // Generate a random salt value
                $salt = substr(md5(time()), 0, 23);
                $user = new User();
                $user->setSalt($salt);
                $user->setRole('ROLE_USER');
            }
        }
        if($request->postExists('username'))
        {
           // On récupère le champ Username
            $username = $request->postData('username');
            $password = $request->postData('password');
            // On récupère l'utilisateur en BDD grace à $username 
            $userBDD = $this->managers->getManagerOf('User')->getByUsername($user->username());
            $pass = $request->postData('password');
            // Ajout du salt au MDP puis hashage avec SHA1 du MDP complet
            $password = sha1( $password . $userBDD->salt());
            if( $password === $userBDD['password'])
            {
                $this->app->user()->setAuthenticated(true) ;
                $_SESSION['role'] = $user['role'];
                $this->app->httpResponse()->redirect('/');
                $this->page->addVar ('user', $userBDD);
            }
            else
            {
                $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect');
            }
        }
            
            
    }
}