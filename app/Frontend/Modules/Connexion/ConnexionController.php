<?php
namespace App\Frontend\Modules\Connexion;
use \BTFram\BackController;
use \BTFram\HTTPRequest;
use \Form\FormBuilder\RegisterFormBuilder;
use \Entity\Users;
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
        $this->processFormUser($request);
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