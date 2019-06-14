<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Elements;

class Select extends BaseElement
{
    protected $template = "select";

    protected $vars = [
        "class" => "form-control",
        "label_class" => "control-label",
        "options" => []
    ];
}
