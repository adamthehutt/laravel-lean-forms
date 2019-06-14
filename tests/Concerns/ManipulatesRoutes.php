<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Tests\Concerns;

use AdamTheHutt\LeanForms\Tests\Fakes\FakeRouter;
use Illuminate\Events\Dispatcher;

trait ManipulatesRoutes
{
    protected function setRouteName($name)
    {
        app()->instance("router", new FakeRouter(new Dispatcher()));
        $router = app("router");
        $router->setCurrentRouteName($name);
    }
}
