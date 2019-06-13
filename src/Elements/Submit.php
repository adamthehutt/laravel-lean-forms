<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Elements;

class Submit extends BaseElement
{
    protected $template = "submit";

    protected $vars = [
        "class" => "btn btn-success"
    ];
}
