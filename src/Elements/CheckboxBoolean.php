<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Elements;

class CheckboxBoolean extends BaseElement
{
    protected $template = "checkbox-boolean";

    protected $vars = [
        "label_class" => "control-label",
        "class" => "checkbox",
        "options" => [0, 1]
    ];
}
