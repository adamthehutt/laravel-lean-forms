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

    public function open($method = null, $action = null): Opening
    {
        $realMethod = $method ?? $this->method();
        $htmlMethod = in_array(strtoupper($realMethod), ['GET', 'POST']) ? $realMethod : "POST";
        $action     = $action ?? $this->route();

        return new Opening($this, compact("realMethod", "htmlMethod", "action"));
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

    protected function element(string $elementClass, array $params = []): BaseElement
    {
        return new $elementClass($this, $params);
    }

    /**
     * Three options:
     * - set as $this->route property in child class
     * - override method in child class
     * - guess based on naming conventions (requires use of a model)
     */
    protected function route()
    {
        if (isset($this->route)) {
            return route($this->route);
        }

        switch($this->guessCurrentAction()) {
            case 'create':
                return route(Str::snake(class_basename($this->model)) . ".store");
            case 'edit':
                return route(Str::snake(class_basename($this->model)) . ".update", [$this->model]);
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
    protected function method()
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
     * Try to determine current crud action based on name of form class
     *
     * @return string
     */
    protected function guessCurrentAction(): string
    {
        return
            strtolower(
                Arr::last(
                    explode("_",
                        Str::snake(
                            class_basename($this)))));
    }
}
