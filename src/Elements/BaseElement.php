<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Elements;

use AdamTheHutt\LeanForms\AbstractForm;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\HtmlString;

/**
 * @method  BaseElement disabled(bool $bool = true)
 * @method  BaseElement readonly(bool $bool = true)
 * @method  BaseElement required(bool $bool = true)
 * @method  BaseElement title(string $title)
 */
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

    final public function __construct(AbstractForm $form, array $vars = [])
    {
        $this->form = $form;
        $this->vars = array_replace_recursive($this->vars, $this->buildInitialParameters($vars));
        $this->vars["__model"] = optional($form->model);
    }

    public function getValue()
    {
        if (!array_key_exists('__value', $this->vars)) {
            $this->vars['__value'] = $this->determineValue();
        }

        return $this->vars['__value'] ?? null;
    }

    public function getSkin(): string
    {
        return $this->form->skin ?? Config::get("lean-forms.skin");
    }

    public function toHtml(): HtmlString
    {
        $this->convertAttributesToHtml();
        $this->vars["includeLabel"] = $this->includeLabel ?? $this->form->wrap ?? true;
        $this->vars["includeFormGroup"] = $this->includeFormGroup ?? $this->form->wrap ?? true;
        if (null == $this->vars['label'] && array_key_exists("name", $this->vars)) {
            $this->vars['label'] = $this->labelFromName($this->vars['name']);
        }
        $this->vars["__value"] = $this->determineValue();

        $namespacedTemplate = "lean-forms::{$this->getSkin()}.{$this->template}";
        $html = app(ViewFactory::class)
            ->make($namespacedTemplate, $this->vars)
            ->render();

        return new HtmlString($html);
    }

    public function id(string $id): self
    {
        $this->vars["id"] = $id;

        return $this;
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

    /**
     * Default is lowest priority value
     */
    public function default($default): self
    {
        $this->vars["default"] = $default ?? null;

        return $this;
    }

    /**
     * Value takes precedence over model property and default but not old form input
     */
    public function value($value): self
    {
        $this->vars["value"] = $value;

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

    public function attr(string $key, string $value): self
    {
        if (false !== $value) {
            $this->vars["attributes"][$key] = $value;
        }

        return $this;
    }

    public function data(string $key, string $value): self
    {
        return $this->attr("data-$key", $value);
    }

    public function nowrap(bool $bool = true): self
    {
        $this->includeFormGroup = $this->includeLabel = !$bool;

        return $this;
    }

    public function labelFromName(string $name): string
    {
        $label = ucwords(str_replace("_", " ", $name));

        // Strip trailing " Id"
        return preg_replace("/\sId$/", "", $label);
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
        } else {
            $this->vars["attributes"][$method] = Arr::first($args) ?? $method;
        }

        return $this;
    }

    protected function buildInitialParameters(array $params = [])
    {
        $standard = [
            "id" => $params["id"] ?? $params["name"] ?? "",
            "name" => $params["name"] ?? "",
            "label" => $params["label"] ?? null,
            "default" => $params["default"] ?? null,
            "attributes" => $params["attributes"] ?? []
        ];

        $extras = array_diff_key($params, $standard);

        return $standard + $extras;
    }

    /**
     * Order of priority (highest to lowest):
     * 1. specially assigned __value
     * 2. old form input
     * 3. explicitly assigned value
     * 4. model property for field name
     * 5. explicitly assigned default
     *
     * @return mixed
     */
    protected function determineValue()
    {
        $old = old($this->dotNotation($this->vars["name"]));
        $modelValue = optional($this->form->model)->{$this->vars['name']};

        return $this->vars["__value"] ??
               $old ??
               $this->vars["value"] ??
               $modelValue ??
               $this->vars["default"];
    }

    protected function convertAttributesToHtml(): void
    {
        $htmlAttributes = "";
        foreach ($this->vars['attributes'] as $attribute => $value) {
            if (is_int($attribute)) {
                $attribute = $value;
            }
            $htmlAttributes .= ' ' . $attribute . '="' . e($value) . '" ';
        }
        $this->vars["attributes"] = $htmlAttributes;
    }

    protected function dotNotation(string $name)
    {
        return str_replace(["[","]"], [".",""], $name);
    }
}
