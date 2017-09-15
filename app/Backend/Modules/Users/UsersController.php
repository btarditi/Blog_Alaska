<?php

namespace App\Backend\Modules\Users;
use \Entity\Users;
use \BTFram\BackController;
use \BTFram\HTTPRequest;
use \Form\FormHandler;
use \Form\FormBuilder\RegisterFormBuilder;
class UsersController extends BackController
{
}
/*namespace App\Backend\Modules\Users;
use \Entity\Users;
use \BTFram\BackController;
use \BTFram\HTTPRequest;
use \BTFram\Form\FormHandler;
use \FormBuilder\UsersFormBuilder;
class UsersController extends BackController
{
    public function executeInscription(HTTPRequest $request)
    {
        $this->processFormUser($request);
        $this->page->addVar('titre', 'Inscription');
    }
    public function executeUserInsert(HTTPRequest $request)
    {
        $this->processFormUser($request);
        $this->page->addVar('titre', 'Ajout d\'un utilisateur');
    }
    public function executeUserUpdate(HTTPRequest $request)
    {
        $this->processFormUser($request);
        $this->page->addVar('titre', 'Modification d\'un utilisateur');
    }
    public function executeUserDelete(HTTPRequest $request)
    {
        $userManager = $this->managers->getManagerOf('Users');
        $commentManager = $this->managers->getManagerOf('Commentaire');
        $commentManager->deleteAllByUser($request->getData('id'));
        $userManager->delete($request->getData('id'));
        $this->app->user()->setFlash('L\'utilisateur et ses commentaires à bien été supprimer.');
        // redirection vers l'Admin
        $this->app->httpResponse()->redirect('/admin/');
    }
    public function processFormUser(HTTPRequest $request)
    {
        if ($request->method() == 'POST') {
            $user = new Users([
                'login' => $request->postData('login'),
                'password' => $request->postData('password'),
                'role' => $request->postData('role')
            ]);
            if ($request->getExists('id')) {
                $user->setId($request->getData('id'));
            }
        } else {
            // L'identifiant de l'utilisateur est transmis si on veut la modifier
            if ($request->getExists('id')) {
                $user = $this->managers->getManagerOf('Users')->find($request->getData('id'));
            } else {
                $user = new Users();
            }
        }
        // Generate a random salt value
        $salt = substr(md5(time()), 0, 23);
        $user->setSalt($salt);
        $plainPassword = $user->password();
        $password = $plainPassword .= $user->salt();
        $password = sha1($password);
        $user->setPassword($password);
        $formBuilder = new UsersFormBuilder($user);
        $formBuilder->build();
        $form = $formBuilder->form();
        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Users'), $request);
        if ($formHandler->process()) {
            $this->app->user()->setFlash($user->isNew() ? 'L\'utilisateur a bien été ajoutée !' : 'L\'utilisateur a bien été modifiée !');
            $this->app->httpResponse()->redirect('/admin/');
        }
        $this->page->addVar('form', $form->createView());
    }
}*/