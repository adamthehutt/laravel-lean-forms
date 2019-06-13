<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Elements;

class Text extends BaseElement
{
    protected $template = "text";

    protected $vars = [
        "class" => "form-control",
        "label_class" => "control-label"
    ];
}
