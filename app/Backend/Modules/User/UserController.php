<?php

namespace App\Backend\Modules\User;
use \Entity\User;
use \BTFram\BackController;
use \BTFram\HTTPRequest;
use \Form\FormHandler;
use \Form\FormBuilder\RegisterFormBuilder;

class UserController extends BackController
{
    // USERS //
    public function executeInsert(HTTPRequest $request)
    {
        $this->processFormUser($request);
        $this->page->addVar('titre', 'Ajout d\'un utilisateur');
    }
    public function executeUpdate(HTTPRequest $request)
    {
        $this->processFormUser($request);
        $this->page->addVar('titre', 'Modification d\'un utilisateur');
    }
    public function executeDelete(HTTPRequest $request)
    {
        $userManager = $this->managers->getManagerOf('User');
//        $commentManager = $this->managers->getManagerOf('Comments');
        $userManager->delete($request->getData('id'));
        $this->app->user()->setFlash('L\'utilisateur et ses commentaires à bien été supprimer.');
        // redirection vers l'Admin
        $this->app->httpResponse()->redirect('/admin/index.html');
    }
    public function processFormUser(HTTPRequest $request)
    {
        if ($request->method() == 'POST') {
            $user = new User([
                'username' => $request->postData('username'),
                'password' => $request->postData('password'),
                'role' => $request->postData('role'),
                'salt' => $request->postData('salt')
            ]);
            $user->setPassword(sha1($user->password() . $user->salt()));
            if ($request->getExists('id')) {
                $user->setId($request->getData('id'));
            }
        }
        else
        {
            // L'identifiant de l'utilisateur est transmis si on veut la modifier
            if ($request->getExists('id')) {
                $user = $this->managers->getManagerOf('User')->getUnique($request->getData('id'));
            }
            else
            {
                $user = new User();
                $user->setSalt(substr(md5(time()), 0, 23));
            }
        }
        $formBuilder = new RegisterFormBuilder($user);
        $formBuilder->build();
        $form = $formBuilder->form();
        $formHandler = new FormHandler($form, $this->managers->getManagerOf('User'), $request);
        if ($formHandler->process()) {
            $this->app->user()->setFlash($user->isNew() ? 'L\'utilisateur a bien été ajoutée !' : 'L\'utilisateur a bien été modifiée !');
            $this->app->httpResponse()->redirect('/admin/index.html');
        }
        $this->page->addVar('form', $form->createView());
    }
}
