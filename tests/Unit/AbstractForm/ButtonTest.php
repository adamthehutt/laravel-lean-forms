<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Tests;

use AdamTheHutt\LeanForms\Elements\Button;
use Orchestra\Testbench\TestCase;

/**
 * @covers \AdamTheHutt\LeanForms\AbstractForm::button
 */
class ButtonTest extends TestCase
{
    /** @test */
    public function it_returns_a_button_object()
    {
        $subject = (new TestForm())->button("Do it now!");

        $this->assertInstanceOf(Button::class, $subject);
    }
}
