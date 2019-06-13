<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Elements;

class Datepicker extends BaseElement
{
    protected $template = "datepicker";

    /** @var array  */
    protected $vars = [
        "class" => "form-control",
        "label_class" => "control-label",
        "attributes" => [
            "data-date-format" => "yyyy-mm-dd"
        ]
    ];
}
