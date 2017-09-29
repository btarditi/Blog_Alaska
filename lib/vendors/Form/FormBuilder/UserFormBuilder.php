<?php
namespace Form\FormBuilder;

use \Form\Field\PasswordField;
use \Form\Field\StringField;
use \Form\Validator\MaxLengthValidator;
use \Form\Validator\NotNullValidator;

class UserFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new StringField([
            'label' => 'Pseudo :',
            'name' => 'username',
            'maxLength' => 30,
            'validators' => [
                new MaxLengthValidator('Le pseudo spécifié est trop long (30 caractères maximum)', 30),
                new NotNullValidator('Merci de spécifier le pseudo de l\'utilisateur'),
                ],
            ]))
            ->add(new StringField([
                  'label' => 'Email :',
                  'name' => 'email',
                  'validators' => [
                      new NotNullValidator('Merci de spécifier le pseudo de l\'utilisateur'),
                  ],
              ]))
            ->add(new PasswordField([
                'label' => 'Mot de passe :',
                'name' => 'password',
                'maxLength' => 15,
                'validators' => [
                    new MaxLengthValidator('Le mot de passe ne doit pas dépasser 15 caractères', 15),
                    new NotNullValidator('Merci de spécifier un mot de passe'),
                ],
            ]))
            ->add(new StringField([
                  'label' => 'Rôle :',
                  'name' => 'role',
                  'validators' => [
                      new NotNullValidator('Merci de spécifier le rôle de l\'utilisateur'),
                  ],
              ]))
        ;
    }
}