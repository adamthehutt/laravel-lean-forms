<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Tests\Unit\Elements\BaseElement;

use AdamTheHutt\LeanForms\Tests\Fakes\FakeElement;
use AdamTheHutt\LeanForms\Tests\TestForm;
use Orchestra\Testbench\TestCase;

class DotNotationTest extends TestCase
{
    /** @var FakeElement */
    public $subject;

    public function setUp(): void
    {
        parent::setUp();

        $this->subject = new FakeElement(new TestForm());
    }

    /** @test */
    public function it_handles_a_flat_string()
    {
        $this->assertEquals("foo", $this->subject->dotNotation("foo"));
    }

    /** @test */
    public function it_handles_a_shallow_array()
    {
        $this->assertEquals("foo.bar", $this->subject->dotNotation("foo[bar]"));
    }

    /** @test */
    public function it_handles_a_deep_array()
    {
        $this->assertEquals("foo.bar.123.baz.quux", $this->subject->dotNotation("foo[bar][123][baz][quux]"));
    }
}
