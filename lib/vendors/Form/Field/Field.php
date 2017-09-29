<?php
namespace Form\Field;

/**
 * Class Field
 * representant les champs des formulaires. 
 */

abstract class Field
{
  // On utilise le trait Hydrator afin que nos objets Field puissent être hydratés
  use \BTFram\Hydrator;
 
  protected $errorMessage;
  protected $label;
  protected $name;
  protected $validator = [];
  protected $value;
  protected $class;
 
  public function __construct(array $options = [])  // recupere liste des attrib et les hydrate
  {
    if (!empty($options))
    {
      $this->hydrate($options);
    }
  }
 
  abstract public function buildWidget();  // renvoyer le code HTML du champ.
 
  public function isValid()  // savoir si le champ est valide ou non
  {
    foreach ($this->validator as $validator)
    {
      if (!$validator->isValid($this->value))
      {
        $this->errorMessage = $validator->errorMessage();
        return false;
      }
    }
 
    return true;
  }
 
//  Getter
  public function label()
  {
    return $this->label;
  }
 
  public function length()
  {
    return $this->length;
  }
 
  public function name()
  {
    return $this->name;
  }
 
  public function validator()
  {
    return $this->validator;
  }
 
  public function value()
  {
    return $this->value;
  }

//  Setter
  public function setLabel($label)
  {
    if (is_string($label))
    {
      $this->label = $label;
    }
  }
 
  public function setLength($length)
  {
    $length = (int) $length;
 
    if ($length > 0)
    {
      $this->length = $length;
    }
  }
 
  public function setName($name)
  {
    if (is_string($name))
    {
      $this->name = $name;
    }
  }
 
  public function setValidators(array $validator)
  {
    foreach ($validator as $validator)
    {
      if ($validator instanceof Validator && !in_array($validator, $this->validator))
      {
        $this->validator[] = $validator;
      }
    }
  }
 
  public function setValue($value)
  {
    if (is_string($value))
    {
      $this->value = $value;
    }
  }
}