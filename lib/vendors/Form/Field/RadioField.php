<?php
namespace Form\Field;

class RadioField extends Field
{
    public function buildWidget()
    {
        $widget = '';
        if (!empty($this->errorMessage))
        {
            $widget .= $this->errorMessage.'<br />';
        }
        $widget .= '<div class="form-group">';
        $widget .= '<label class="col-sm-3 control-label" for="'. $this->name . '" >' . $this->label .'</label>';
        $widget .= '<div class="col-sm-9">';
        $widget .= '<input class="form-control" type="radio" name="' . $this->name . '" ';
        if (!empty($this->value))
        {
            $widget .= ' value="'.htmlspecialchars($this->value).'"';
        }
        return $widget .= ' />'. $this->value .'</div></div>';
    }
}