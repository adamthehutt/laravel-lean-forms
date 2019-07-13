<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Elements;

class Datepicker extends BaseElement
{
    protected $template = "datepicker";

    protected $vars = [
        "attributes" => [
            "data-date-format" => "yyyy-mm-dd"
        ]
    ];
}
