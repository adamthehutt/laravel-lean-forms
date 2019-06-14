<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Tests;

use AdamTheHutt\LeanForms\AbstractForm;

class TestForm extends AbstractForm
{
    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function setRoute($route)
    {
        $this->route = $route;
    }
}
