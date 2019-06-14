<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Elements;

class Button extends BaseElement
{
    protected $template = "button";

    protected $vars = [
        "class" => "btn btn-primary"
    ];
}
