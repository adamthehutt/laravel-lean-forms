<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Tests\Unit\Elements\Text;

use AdamTheHutt\LeanForms\Elements\Text;
use AdamTheHutt\LeanForms\Tests\Giraffe;
use AdamTheHutt\LeanForms\Tests\TestForm;
use Orchestra\Testbench\TestCase;

/**
 * @covers \AdamTheHutt\LeanForms\Elements\BaseElement::getValue
 * @covers \AdamTheHutt\LeanForms\Elements\BaseElement::determineValue
 */
class GetValueTest extends TestCase
{
    /** @var TestForm */
    public $form;

    /** @var Text */
    public $subject;

    public function setUp(): void
    {
        parent::setUp();

        $this->form = new TestForm();
        $this->subject = new Text($this->form);
    }

    /** @test */
    public function it_starts_empty()
    {
        $this->assertNull($this->subject->getValue());
    }

    /** @test */
    public function it_prefers_default()
    {
        $this->subject->default("foo");

        $this->assertEquals("foo", $this->subject->getValue());
    }

    /** @test */
    public function it_prefers_model_property()
    {
        $this->subject->name("foo")
                      ->default("bar");

        $this->form->model = new Giraffe();
        $this->form->model->foo = "baz";

        $this->assertEquals("baz", $this->subject->getValue());
    }

    /** @test */
    public function it_prefers_explicit_value()
    {
        $this->subject->name("foo")
                      ->default("bar");

        $this->form->model = new Giraffe();
        $this->form->model->foo = "baz";

        $this->subject->value("quux");

        $this->assertEquals("quux", $this->subject->getValue());
    }
}
