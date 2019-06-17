<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Elements;

class Radio extends BaseElement
{
    protected $template = "radio";

    protected $vars = [
        "class" => "form-control",
        "label_class" => "control-label",
        "options" => []
    ];
}
