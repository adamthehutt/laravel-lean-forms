<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Tests;

use AdamTheHutt\LeanForms\Elements\Submit;
use Orchestra\Testbench\TestCase;

/**
 * @covers \AdamTheHutt\LeanForms\AbstractForm::submit
 */
class SubmitTest extends TestCase
{
    /** @test */
    public function it_returns_a_submit_object()
    {
        $subject = (new TestForm())->submit("Save the Thingy");

        $this->assertInstanceOf(Submit::class, $subject);
    }
}
