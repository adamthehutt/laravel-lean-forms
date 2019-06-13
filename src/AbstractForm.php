<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms;

use AdamTheHutt\LeanForms\Elements\BaseElement;
use AdamTheHutt\LeanForms\Elements\Opening;
use AdamTheHutt\LeanForms\Elements\Submit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;

abstract class AbstractForm
{
    /** @var string  */
    public $skin = "bootstrap3";

    /** @var Model */
    public $model;

    /** @var string */
    protected $method = 'GET';

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
        $realMethod = $method ?? $this->method;
        $htmlMethod = in_array(strtoupper($realMethod), ['GET', 'POST']) ? $realMethod : "POST";
        $action     = $action ?? route($this->route);

        return new Opening($this, compact("realMethod", "htmlMethod", "action"));
    }

    public function submit(string $text = "Submit"): Submit
    {
        return (new Submit($this))->default($text);
    }

    public function close(): HtmlString
    {
        return new HtmlString("</form>");
    }

    /**
     * @param  BaseElement[]  ...$args
     *
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
}
