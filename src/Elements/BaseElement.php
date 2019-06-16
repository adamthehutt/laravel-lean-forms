<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Elements;

use AdamTheHutt\LeanForms\AbstractForm;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\HtmlString;

class BaseElement implements Htmlable
{
    /** @var bool  */
    public $includeFormGroup;

    /** @var bool  */
    public $includeLabel;

    /** @var AbstractForm  */
    protected $form;

    /** @var array  */
    protected $vars = [];

    /** @var string */
    protected $template;

    /** @var array  */
    protected $dataAttributes = ["toggle"];

    final public function __construct(AbstractForm $form, array $vars = [])
    {
        $this->form = $form;
        $this->vars = array_replace_recursive($this->vars, $this->parseParameters($vars));
        $this->vars["__model"] = optional($form->model);
    }

    public function toHtml(): HtmlString
    {
        $htmlAttributes = "";
        foreach ($this->vars['attributes'] as $attribute => $value) {
            if (is_int($attribute)) {
                $attribute = $value;
            }
            $htmlAttributes .= ' ' . $attribute . '="' . e($value) . '" ';
        }
        $this->vars["attributes"] = $htmlAttributes;
        $this->vars["includeLabel"] = $this->includeLabel ?? $this->form->wrap ?? true;
        $this->vars["includeFormGroup"] = $this->includeFormGroup ?? $this->form->wrap ?? true;

        $skin = $this->form->skin ?? Config::get("lean-forms.skin");

        return new HtmlString(
            view("lean-forms::{$skin}.{$this->template}", $this->vars)->render()
        );
    }

    public function name(string $name): self
    {
        $this->vars["name"] = $name;

        return $this;
    }

    public function label(string $label): self
    {
        $this->vars["label"] = $label;

        return $this;
    }

    public function default($default): self
    {
        $this->vars["default"] = (string) $default ?? null;

        return $this;
    }

    public function class(?string $class): self
    {
        $this->vars["class"] = $class;

        return $this;
    }

    public function labelClass(?string $class): self
    {
        $this->vars["label_class"] = $class;

        return $this;
    }

    public function options(iterable $options): self
    {
        if (is_array($options) && !Arr::isAssoc($options)) {
            $options = array_combine($options, $options);
        }

        $this->vars["options"] = $options;

        return $this;
    }

    public function attr($key, $value): self
    {
        $this->vars["attributes"][$key] = $value;

        return $this;
    }

    /**
     * Use this for, e.g.,
     * ->required()
     * ->placeholder("some text")
     *
     * @param  string  $method
     * @param  array  $args
     *
     * @return BaseElement
     */
    public function __call(string $method, $args = []): self
    {
        if (false === Arr::first($args)) {
            if (array_key_exists($method, $this->vars["attributes"])) {
                unset($this->vars["attributes"][$method]);
            }
        } elseif (array_key_exists($method, $this->vars)) {
            $this->vars[$method] = Arr::first($args);
        } elseif (in_array($method, $this->dataAttributes)) {
            $this->vars["attributes"]["data-$method"] = Arr::first($args);
        } else {
            $this->vars["attributes"][$method] = Arr::first($args) ?? $method;
        }

        return $this;
    }

    protected function parseParameters(array $params = [])
    {
        $standard = [
            "name" => $params["name"] ?? "",
            "label" => $params["label"] ?? null,
            "default" => $params["default"] ?? null,
            "attributes" => $params["attributes"] ?? []
        ];

        $extras = array_diff_key($params, $standard);

        return $standard + $extras;
    }
}
