<?php
namespace Form\Validator;
 
class NotNullValidator extends Validator
{
  public function isValid($value)
  {
    return $value != '';
  }
}