<?php
namespace App\Backend\Modules\Connexion;
 
use \BTFram\BackController;
use \BTFram\HTTPRequest;
use \Entity\Users;
use \FormBuilder\UsersFormBuilder;
use \BTFram\Form\FormHandler;

 
class ConnexionController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    $this->page->addVar('titre', 'Connexion');
 
    if ($request->postExists('login'))
    {
      $login = $request->postData('login');
      $password = $request->postData('password');
 
      if ($login == $this->app->config()->get('login') && $password == $this->app->config()->get('pass'))
      {
        $this->app->user()->setAuthenticated(true);
        $this->app->httpResponse()->redirect('.');
      }
      else
      {
        $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
      }
    }
  }
    
  public function executeDisconnect(HTTPRequest $request)
    {
        $this->app->user()->setAuthenticated(false);
        $this->app->httpResponse()->redirect('/');
        $this->app->user()->setFlash('Vous êtes déconnecter !');
    }
}