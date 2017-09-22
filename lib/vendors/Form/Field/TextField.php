<?php
namespace Form\Field;
 
class TextField extends Field
{
  protected $cols;
  protected $rows;
 
  public function buildWidget()
  {
    $widget = '';
 
    if (!empty($this->errorMessage))
    {
      $widget .= $this->errorMessage.'<br />';
    }
 
    $widget .= '<div class="form-group">';
    $widget .= '<label class="col-sm-3 control-label">'.$this->label.'</label>';
    $widget .= '<div class="col-sm-9">';
    $widget .= '<textarea class="form-control" name="'.$this->name.'"';
 
    if (!empty($this->cols))
    {
      $widget .= ' cols="'.$this->cols.'"';
    }
 
    if (!empty($this->rows))
    {
      $widget .= ' rows="'.$this->rows.'"';
    }
 
    $widget .= '>';
 
    if (!empty($this->value))
    {
      $widget .= 'value="'.htmlspecialchars($this->value).'" ' ;
    }
    $widget .= '></div></div>';
    return $widget.'</textarea>';
  }
 
  public function setCols($cols)
  {
    $cols = (int) $cols;
 
    if ($cols > 0)
    {
      $this->cols = $cols;
    }
  }
 
  public function setRows($rows)
  {
    $rows = (int) $rows;
 
    if ($rows > 0)
    {
      $this->rows = $rows;
    }
  }
}