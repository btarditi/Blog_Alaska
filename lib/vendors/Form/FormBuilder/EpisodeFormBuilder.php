<?php
namespace Form\FormBuilder;

use \Form\Field\StringField;
use \Form\Field\TextField;
use \Form\Validator\MaxLengthValidator;
use \Form\Validator\NotNullValidator;

/**
 * Class EpisodeFormBuilder
 * Constructeur du formulaire Episode 
 */
class EpisodeFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new StringField([
            'label' => 'Auteur',
            'name' => 'auteur',
            'value' => 'Jean Forteroche',
            'disabled' => 'disabled',
            'maxLength' => 30,
            'validator' => [
                new MaxLengthValidator('L\'auteur spécifié est trop long (30 caractères maximum)', 30),
                new NotNullValidator('Merci de spécifier l\'auteur de cet épisode'),
            ],
        ]))
            ->add(new StringField([
                'label' => 'Titre',
                'name' => 'titre',
                'maxLength' => 100,
                'validator' => [
                    new MaxLengthValidator('Le titre spécifié est trop long (100 caractères maximum)', 100),
                    new NotNullValidator('Merci de spécifier le titre de l\épisode'),
                ],
            ]))
            ->add(new TextField([
                'label' => 'Contenu',
                'name' => 'contenu',
                'rows' => 8,
                'cols' => 220,
                'validator' => [
                    new NotNullValidator('Merci de spécifier le contenu de l\'épisode'),
                ]
            ]));
    }
}