<?php
namespace Form\Field;

/**
 * Class StringField
 * representant les champs strings des formulaires. 
 */
class StringField extends Field
{
    protected $maxLength;
    protected $disabled;
    
    public function buildWidget()
    {
        $widget = '';
 
        if (!empty($this->errorMessage))
        {
        $widget .= $this->errorMessage.'<br />';
        }
 
        $widget .= '<label>'.$this->label.'</label><input type="text" name="'.$this->name.'" class="form-control"';
 
        if (!empty($this->value))
        {
            $widget .= ' value="'.htmlspecialchars($this->value).'"';
        }
        if(isset($this->disabled))
        {
            $widget .= ' disabled';
        }
        if (!empty($this->maxLength))
        {
            $widget .= ' maxlength="'.$this->maxLength.'"';
        }
        return $widget .= ' /></div></div>';
    }
 
    public function setMaxLength($maxLength)
    {
        $maxLength = (int) $maxLength;
 
        if ($maxLength > 0)
        {
            $this->maxLength = $maxLength;
        }
        else
        {
            throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
        }
    }
    
    public function setDisabled( $disabled )
    {
        $this->disabled = $disabled;
    }
}