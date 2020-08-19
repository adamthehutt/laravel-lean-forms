<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms;

use AdamTheHutt\LeanForms\Elements\BaseElement;
use AdamTheHutt\LeanForms\Elements\Button;
use AdamTheHutt\LeanForms\Elements\Opening;
use AdamTheHutt\LeanForms\Elements\Submit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

abstract class AbstractForm
{
    /** @var string  */
    public $skin;

    /** @var Model */
    public $model;

    /** @var array  */
    public $fields = [];

    /** @var bool   Whether to accept file inputs */
    public $files;

    /** @var bool   Whether to wrap the form fields with label, div.form-group, etc. */
    public $wrap = true;

    /** @var string */
    protected $method;

    /** @var string */
    protected $route;

    /** @var Request */
    protected $request;

    public function __construct(Model $model = null)
    {
        if ($model) {
            $this->model = $model;
        }

        $this->request = app('request');
    }

    /**
     * For plain vanilla fields we may not need to define a full method in the
     * child form class. Instead, we rely on basic configuration and
     * convention.
     */
    public function __call(string $method, array $args): BaseElement
    {
        $fieldName = Str::snake($method);

        if (isset($this->fields[$fieldName])) {
            return $this->element($this->fields[$fieldName], ['name' => $fieldName]);
        }

        throw new \RuntimeException("Failed to handle call for field \"$method\"");
    }
    
    /**
     * @param string $field
     * @return mixed
     */
    public function __get(string $field)
    {
        if (method_exists($this, $field)) {
            return $this->$field()->getValue();
        }

        $snake = Str::snake($field);

        return old($field)
            ?? old($snake)
            ?? optional($this->model)->$field
            ?? optional($this->model)->$snake;
    }

    public function json(array $fields)
    {
        return json_encode(
            array_combine($fields, array_map(fn ($field) => $this->__get($field), $fields))
        );
    }

    public function open($method = null, $action = null): Opening
    {
        $realMethod = $method ?? $this->method();
        $htmlMethod = in_array(strtoupper($realMethod), ['GET', 'POST']) ? $realMethod : "POST";
        $action     = $action ?? $this->route();
        $files      = $this->files;

        return new Opening($this, compact("realMethod", "htmlMethod", "action", "files"));
    }

    public function submit(string $text = "Submit"): Submit
    {
        return (new Submit($this))->default($text);
    }

    public function button(string $text = "Submit"): Button
    {
        return (new Button($this))->default($text);
    }

    public function close(): HtmlString
    {
        return new HtmlString("</form>");
    }

    /**
     * Three options:
     * - set as $this->route property in child class
     * - override method route() in child class
     * - guess based on naming conventions (requires use of a model)
     */
    public function route()
    {
        if (isset($this->route)) {
            return route($this->route);
        }

        switch($this->guessCurrentAction()) {
            case 'create':
                return route(Str::snake(class_basename($this->model)) . ".store");
            case 'edit':
                return route(Str::snake(class_basename($this->model)) . ".update", [$this->model]);
            case 'destroy':
                return route(Str::snake(class_basename($this->model)) . ".destroy", [$this->model]);
            default:
                throw new \RuntimeException("Could not determine what route to use for the form");
        }
    }

    /**
     * Four options:
     * - set as $this->method property in child class
     * - override method in child class
     * - guess based on naming conventions
     * - fallback to GET
     */
    public function method()
    {
        if (isset($this->method)) {
            return $this->method;
        }

        $currentAction = $this->guessCurrentAction();

        $conventions = [
            'create' => 'POST',
            'edit' => 'PUT'
        ];

        return $conventions[$currentAction] ?? "GET";
    }

    /**
     * Try to determine current crud action based on name of route or, failing that, form class
     *
     * @return string
     */
    public function guessCurrentAction(): string
    {
        if ($routeName = app("router")->currentRouteName()) {
            return Arr::last(explode(".", $routeName));
        } else {
            return strtolower(
                       Arr::last(
                           explode("_",
                               Str::snake(
                                   class_basename($this)))));
        }
    }

    /**
     * @param  BaseElement[]  ...$args
     *
     * @return HtmlString
     * @throws \Throwable
     */
    protected function composite(...$args): HtmlString
    {
        $combined = "";
        /** @var BaseElement $arg */
        foreach ($args as $arg) {
            $combined .= $arg->toHtml();
        }

        return new HtmlString($combined);
    }
    
    protected function element(string $elementClass, array $params = [])
    {
        // Use some cleverness to guess a default field name
        // We'll take the method name that was called on the form and snake_case_it
        // This is easily overridden by anyone calling ->name("abc") on the element
        if (!array_key_exists("name", $params)) {
            $methodName = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['function'];
            $params["name"] = Str::snake($methodName);
        }

        return new $elementClass($this, $params);
    }
}
