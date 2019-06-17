<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Elements;

use Illuminate\Support\HtmlString;

class Select extends BaseElement
{
    protected $template = "select";

    protected $vars = [
        "class" => "form-control",
        "label_class" => "control-label",
        "options" => []
    ];

    /**
     * Override parent method so we can "collect" a super __value
     */
    public function toHtml(): HtmlString
    {
        $this->vars["__value"] = collect($this->determineValue());

        return parent::toHtml();
    }
}
