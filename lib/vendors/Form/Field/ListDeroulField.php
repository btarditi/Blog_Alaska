<?php
namespace Form\Field;

/**
 * Class ListDeroulField
 * representant les listes deroulante des formulaires. 
 */
class ListDeroulField extends Field
{
    protected $optionValue1;
    protected $optionValue2;
    
    public function setOptionValue1($optionValue1)
    {
        $this->optionValue1 = $optionValue1;
    }
    
    public function setOptionValue2($optionValue2)
    {
        $this->optionValue2 = $optionValue2;
    }
    
    public function buildWidget()
    {
        $this->setOptionValue1($this->optionValue1);
        $this->setOptionValue2($this->optionValue2);
        $widget = '';
        if (!empty($this->errorMessage))
        {
            $widget .= $this->errorMessage . '<br />';
        }
        
        $widget .= '<div class="form-group">';
        $widget .= '<label class="col-sm-3 control-label" for="' . $this->name . '" >' . $this->label . '</label>';
        $widget .= '<div class="col-sm-9">';
        $widget .= '<select class="form-control" name="' . $this->name . '" size ="1" ><br />';
        
        $widget .= '<OPTION value="' . $this->optionValue1 . '" >"';
        $widget .= $this->optionValue1  .  '"</OPTION><br /> ';
        $widget .= '<OPTION value="' . $this->optionValue2 . '" > "';
        $widget .= $this->optionValue2 . '"</OPTION><br />';
        
        return $widget .= '</select></div></div>';
    }
}