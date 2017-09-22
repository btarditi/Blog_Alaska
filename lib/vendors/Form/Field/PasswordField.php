<?php
namespace Form\Field;

class PasswordField extends Field
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
        $widget .= '<input class="form-control" type="password" required="true" name="' . $this->name . '"  ';
        if (!empty($this->maxLength))
        {
            $widget .= ' maxlength="'.$this->maxLength.'"';
        }
        $widget .= '/></div></div>';
        return $widget;
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
}