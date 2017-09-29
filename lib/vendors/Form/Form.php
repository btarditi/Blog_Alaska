<?php
namespace Form;

use \BTFram\Entity;
use \Form\Field\Field;

/**
 * Class Form
 * représente le formulaire
 */
class Form
{
    protected $entity;
    protected $fields = [];
 
    public function __construct(Entity $entity)
    {
        $this->setEntity($entity);
    }
 
    public function add(Field $field)  // ajouter des champs à sa liste de champs.
    {
        $attr = $field->name(); // On récupère le nom du champ.
        $field->setValue($this->entity->$attr()); // On assigne la valeur correspondante au champ.
        $this->fields[] = $field; // On ajoute le champ passé en argument à la liste des champs.
        return $this;
    }
 
    public function createView()  // afficher notre formulaire.
    {
        $view = '';
        // On génère un par un les champs du formulaire.
        foreach ($this->fields as $field)
        {
          $view .= $field->buildWidget().'<br />';
        }
        return $view;
    }
 
    public function isValid()  // vérifier si tous les champs sont valides.
    {
        $valid = true;
        foreach ($this->fields as $field)
        {
          if (!$field->isValid())
          {
            $valid = false;
          }
        }
        return $valid;
    }
 
    public function entity()  // Getter
    {
        return $this->entity;
    }
 
    public function setEntity(Entity $entity)  // Setter
    {
        $this->entity = $entity;
    }

}