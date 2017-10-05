<?php
namespace Form\FormBuilder;

use \Form\Field\PasswordField;
use \Form\Field\StringField;
use \Form\Field\EmailField;
use \Form\Validator\MaxLengthValidator;
use \Form\Validator\NotNullValidator;

/**
 * Class RegisterFormBuilder
 * Constructeur du formulaire d'inscription 
 */
class RegisterFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form
            ->add(new StringField([
            'label' => 'Pseudo',
            'name' => 'username',
            'maxLength' => 30,
            'validator' => [
                new MaxLengthValidator('Le pseudo spécifié est trop long (30 caractères maximum)', 30),
                new NotNullValidator('Merci de spécifier le pseudo de l\'utilisateur'),
                ],
            ]))
            ->add(new EmailField([
            'label' => 'Email :',
            'name' => 'email',
            'validator' => [
                new NotNullValidator('Merci de spécifier une adresse email !'),
                ],
            ]))
            ->add(new PasswordField([
                'label' => 'Mot de passe',
                'name' => 'password',
                'maxLength' => 15,
                'validator' => [
                    new MaxLengthValidator('Le mot de passe ne doit pas dépasser 15 caractères', 15),
                    new NotNullValidator('Merci de spécifier un mot de passe'),
                ],
            ]));
        
    }
}