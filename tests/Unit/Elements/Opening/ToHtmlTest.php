<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Tests\Unit\Elements\Opening;

use AdamTheHutt\LeanForms\Elements\Opening;
use AdamTheHutt\LeanForms\Tests\Concerns\ReliesOnViews;
use AdamTheHutt\LeanForms\Tests\TestCreate;
use Orchestra\Testbench\TestCase;

/** @covers \AdamTheHutt\LeanForms\Elements\Opening::toHtml */
class ToHtmlTest extends TestCase
{
    use ReliesOnViews;

    /** @test */
    public function it_contains_an_opening_form_tag()
    {
        $subject = new Opening(
            new TestCreate(), [
                "realMethod" => "POST",
                "htmlMethod" => "POST",
                "action" => "/foo"
            ]);

        $this->assertStringStartsWith("<form", $subject->toHtml()->__toString());
    }

    /** @test */
    public function it_contains_the_csrf_token()
    {
        $subject = new Opening(
            new TestCreate(), [
            "realMethod" => "POST",
            "htmlMethod" => "POST",
            "action" => "/foo"
        ]);

        $this->assertStringContainsString('name="_token"', $subject->toHtml()->__toString());
    }

    /** @test */
    public function it_contains_the_secret_method()
    {
        $subject = new Opening(
            new TestCreate(), [
            "realMethod" => "PUT",
            "htmlMethod" => "POST",
            "action" => "/foo"
        ]);

        $this->assertStringContainsString('name="_method" value="PUT"', $subject->toHtml()->__toString());
    }

    /** @test */
    public function it_omits_the_secret_method()
    {
        $subject = new Opening(
            new TestCreate(), [
            "realMethod" => "POST",
            "htmlMethod" => "POST",
            "action" => "/foo"
        ]);

        $this->assertStringNotContainsString('name="_method"', $subject->toHtml()->__toString());
    }
}
