<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Tests\Features\Manager;

use AdamTheHutt\LeanForms\LeanFormsServiceProvider;
use AdamTheHutt\LeanForms\Tests\TestEdit;
use Illuminate\Support\Facades\Config;
use Orchestra\Testbench\TestCase;

class FormClassResolutionTest extends TestCase
{
    public function getPackageProviders($app)
    {
        return [LeanFormsServiceProvider::class];
    }

    /** @test */
    public function it_finds_a_form()
    {
        Config::set("lean-forms.namespaces", ["AdamTheHutt\\LeanForms\\Tests"]);

        $form = app("forms")->form("test_edit");

        $this->assertInstanceOf(TestEdit::class, $form);
    }

    /** @test */
    public function it_throws_an_exception_when_it_cant_find_anything()
    {
        Config::set("lean-forms.namespaces", ["AdamTheHutt\\LeanForms\\Tests"]);

        $this->expectException(\Exception::class);

        app("forms")->form("nothing_to_see.here");
    }
}
