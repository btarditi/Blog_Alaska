<?php
namespace Form\FormBuilder;

use \BTFram\Entity;
use \Form\Form;

/**
 * Class Form
 * Constructeur de formulaire
 */

abstract class FormBuilder
{
    protected $form;
    
    public function __construct(Entity $entity)  
    {
        $this->setForm(new Form($entity));
    }
    
    abstract public function build();  // construire le formulaire.
    
//  Setter    
    public function setForm(Form $form)
    {
        $this->form = $form;
    }

//  Getter
    public function form()
    {
        return $this->form;
    }
}