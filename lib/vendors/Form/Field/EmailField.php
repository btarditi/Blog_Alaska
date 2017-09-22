<?php
namespace Form\Field;

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
            $widget .= '<input class="form-control" type="email" name="' . $this->name . '"  ';
            if(is_string($this->required)) {
                $widget .= $this->required;
            }
            $widget .= '/></div></div>';
        return $widget;
    }
}