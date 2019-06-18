<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Elements;

class Datetimepicker extends BaseElement
{
    protected $template = "datetimepicker";

    /** @var array  */
    protected $vars = [
        "class" => "form-control",
        "label_class" => "control-label"
    ];
}
