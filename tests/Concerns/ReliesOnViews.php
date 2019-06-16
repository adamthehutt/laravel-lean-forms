<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Tests\Concerns;

trait ReliesOnViews
{
    public function setUp(): void
    {
        parent::setUp();

        app("config")->set("lean-forms.skin", "bootstrap3");
        app('view')->addNamespace('lean-forms', __DIR__ . "/../../resources/views/");
    }
}
