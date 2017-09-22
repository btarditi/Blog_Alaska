<?php
namespace Form\FormBuilder;

use \Form\Field\StringField;
use \Form\Field\TextField;
use \Form\Validator\MaxLengthValidator;
use \Form\Validator\NotNullValidator;

class CommentFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new StringField([
            'label' => 'Auteur',
            'name' => 'auteur',
            'maxLength' => 50,
            'validator' => [
                new MaxLengthValidator('L\'auteur spécifié est trop long (50 caractères maximum)', 50),
                new NotNullValidator('Merci de spécifier l\'auteur du commentaire'),
            ],
        ]))
            ->add(new TextField([
                'label' => 'Contenu',
                'name' => 'contenu',
                'rows' => 7,
                'cols' => 50,
                'validator' => [
                    new NotNullValidator('Merci de spécifier votre commentaire'),
                ],
            ]));
    }
}