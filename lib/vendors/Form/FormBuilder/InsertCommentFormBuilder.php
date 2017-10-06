<?php
namespace Form\FormBuilder;

use Form\Field\HiddenField;
use \Form\Field\StringField;
use \Form\Field\TextField;
use \Form\Validator\MaxLengthValidator;
use \Form\Validator\NotNullValidator;


/**
 * Class CommentFormBuilder
 * Constructeur du formulaire commentaire 
 */

class InsertCommentFormBuilder extends FormBuilder
{
    public function build()
    {
    $this->form
                ->add(new HiddenField([
                    'label' => 'Episode associé : :',
                    'name' => 'episodeId',
                    'value' => $_GET['id'],
                    'disabled' => 'disabled',
                    'validator' => [
                        new NotNullValidator('Aucun épisode associé au commentaire !!!'),
                    ],
                ]))
                ->add(new StringField([
                    'label' => 'Auteur',
                    'name' => 'auteur',
                    'maxLength' => 30,
                    'validator' => [
                        new MaxLengthValidator('L\'auteur spécifié est trop long (30 caractères maximum)', 30),
                        new NotNullValidator('Merci de spécifier l\'auteur du commentaire'),
                    ],
                ]))
                ->add(new TextField([
                    'label' => 'Message',
                    'name' => 'contenu',
                    'rows' => 7,
                    'cols' => 50,
                    'validator' => [
                        new NotNullValidator('Merci de spécifier votre commentaire'),
                    ],
                ]));
    }
}