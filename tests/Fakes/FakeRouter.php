<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Tests\Fakes;

use Illuminate\Routing\Router;

class FakeRouter extends Router
{
    private $currentRouteName;

    public function setCurrentRouteName($name)
    {
        $this->currentRouteName = $name;
    }

    public function currentRouteName()
    {
        return $this->currentRouteName ?? parent::currentRouteName();
    }
}
