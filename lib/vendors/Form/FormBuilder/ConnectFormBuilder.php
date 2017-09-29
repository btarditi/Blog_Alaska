<?php
namespace Form\FormBuilder;

use \Form\Field\HiddenField;
use \Form\Field\PasswordField;
use \Form\Field\StringField;
use \Form\Validator\MaxLengthValidator;
use \Form\Validator\NotNullValidator;

/**
 * Class ConnectFormBuilder
 * Constructeur du formulaire de Connexion 
 */
class ConnectFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new StringField([
            'label' => 'Pseudo :',
            'name' => 'username',
            'maxLength' => 30,
            'validator' => [
                new MaxLengthValidator('Le pseudo spécifié est trop long (30 caractères maximum)', 30),
                new NotNullValidator('Merci de spécifier le pseudo de l\'utilisateur'),
            ],
        ]))
            ->add(new PasswordField([
                'label' => 'Mot de passe :',
                'name' => 'password',
                'validator' => [
                    new NotNullValidator('Merci de spécifier un mot de passe'),
                ],
            ]));
    }
}