<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Tests;

use AdamTheHutt\LeanForms\Tests\Concerns\ManipulatesRoutes;
use Orchestra\Testbench\TestCase;

/**
 * @covers \AdamTheHutt\LeanForms\AbstractForm::guessCurrentAction
 */
class GuessCurrentActionTest extends TestCase
{
    use ManipulatesRoutes;

    /** @test */
    public function it_extracts_from_current_route()
    {
        $this->setRouteName("giraffe.create");

        $subject = new TestForm();

        $this->assertEquals("create", $subject->guessCurrentAction());
    }

    /**
     * @test
     */
    public function it_falls_back_on_class_name_convention()
    {
        $this->setRouteName("");

        $subject = new TestEdit();

        $this->assertEquals("edit", $subject->guessCurrentAction());
    }
}
