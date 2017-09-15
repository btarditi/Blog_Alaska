<?php
namespace FormBuilder;
use \BTFram\FormBuilder;
use BTFram\PasswordField;
use \BTFram\StringField;
use \BTFram\TextField;
use \BTFram\MaxLengthValidator;
use \BTFram\NotNullValidator;

class UsersFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form
            ->add(new StringField([
            'label' => 'Pseudo',
            'name' => 'pseudo',
            'maxLength' => 30,
            'validators' => [
                new MaxLengthValidator('Le pseudo spécifié est trop long (30 caractères maximum)', 20),
                new NotNullValidator('Merci de spécifier le pseudo de l\'utilisateur'),
                ],
            ]))
            ->add(new PasswordField([
                'label' => 'Mot de passe',
                'name' => 'pwd1',
                'validators' => [
                    new NotNullValidator('Merci de spécifier un mot de passe'),
                ],
            ]))
            ->add(new PasswordField([
                'label' => 'Retapez votre mot de passe',
                'name' => 'pwd2',
                'validators' => [
                    new NotNullValidator('Merci de spécifier un mot de passe'),
                ],
            ]));
        // Ajouter encore un champ avec  2 boutons radios, afin de selectionner le role de l'utilisateur (ROLE_ADMIN ou ROLE_USER)wc
    }
}