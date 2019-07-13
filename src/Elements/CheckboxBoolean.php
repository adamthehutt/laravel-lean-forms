<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Elements;

class CheckboxBoolean extends BaseElement
{
    protected $template = "checkbox-boolean";

    protected $vars = [
        "options" => [0, 1]
    ];
}
