<?php
namespace Form\Field;

/**
 * Class EmailField
 * representant les champs Email des formulaires. 
 */
class EmailField extends Field
{
    public function buildWidget()
    {
        $widget = '';
        if (!empty($this->errorMessage))
        {
            $widget .= $this->errorMessage.'<br />';
        }
        $widget .= '<div class="form-group">';
            $widget .= '<label class="col-sm-3 control-label" for="' . $this->name . '" >' . $this->label . '</label>';
            $widget .= '<div class="col-sm-9">';
            $widget .= '<input class="form-control" type="email" required name="' . $this->name . '"  ';
            if(!empty($this->value))
            {
                $widget .= ' value="'.htmlspecialchars($this->value).'"';
            }
            $widget .= '/></div></div>';
        return $widget;
    }
}