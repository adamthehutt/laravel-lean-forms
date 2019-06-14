<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Tests;

use AdamTheHutt\LeanForms\Tests\Concerns\ManipulatesRoutes;
use Orchestra\Testbench\TestCase;

/**
 * @covers \AdamTheHutt\LeanForms\AbstractForm::method
 */
class MethodTest extends TestCase
{
    use ManipulatesRoutes;

    /**
     * @test
     */
    public function it_inspects_current_action()
    {
        $this->setRouteName("giraffe.create");

        $subject = new TestForm();

        $this->assertEquals("POST", $subject->method());
    }

    /** @test */
    public function it_prefers_class_property()
    {
        $this->setRouteName("giraffe.create");

        $subject = new TestForm();
        $subject->setMethod("PUT");

        $this->assertEquals("PUT", $subject->method());
    }

    /** @test */
    public function it_guesses_get_when_all_else_fails()
    {
        $subject = new TestForm();

        $this->assertEquals("GET", $subject->method());
    }
}
