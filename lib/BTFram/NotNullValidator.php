<?php
namespace BTFram;
 
class NotNullValidator extends Validator
{
  public function isValid($value)
  {
    return $value != '';
  }
}