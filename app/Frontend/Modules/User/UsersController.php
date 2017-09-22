<?php
namespace App\Frontend\Modules\Users;
use \Entity\User;
use \BTFram\BackController;
use \BTFram\HTTPRequest;
use \Form\FormHandler;
use \Form\FormBuilder\RegisterFormBuilder;

class UsersController extends BackController
{

 /**
 * Register a user in the BDD
 * @param HTTPRequest $request
 */    
    public function executeRegister(HTTPRequest $request)
    {
        $this->processFormUser($request);
        $this->page->addVar('titre', 'Inscription');
    }
    
/**
* FormHandler for the user register
* @param HTTPRequest $request
*/
    public function processFormUser(HTTPRequest $request)
    {
//  ADD A USER
// Si le Formulaire à bien été envoyé
        if ($request->method() == 'POST')
        { 
// On crée un nouvel ogbjet USER
// Assignation a l'objet User des données saisie
            $user = new User([
                'username' => htmlspecialchars($request->postData('username')),
                'password' => sha1(htmlspecialchars($request->postData('password') . $request->postData('salt')) ),
                //'salt' => htmlspecialchars($request->postData('salt')),
                //'role' => htmlspecialchars($request->postData('role')),
            ]);
            if ($request->getExists('id'))
            {
                $user->setId($request->getData('id'));
            }
        } 
        else
        {
            $user = new User();
        }
        $formBuilder = new RegisterFormBuilder($user);
        $formBuilder->build();
        $form = $formBuilder->form();
        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Users'), $request);
        if ($formHandler->process())
        {
            if($user->isNew() ) {
                $this->app->user()->setFlash('Félicitation, vous faites maintenant officiellement partie de l\'aventure');
            }
            $this->app->httpResponse()->redirect('/index.html');
        }
        $this->page->addVar('form', $form->createView());
    } 
} 