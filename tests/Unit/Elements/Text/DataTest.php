<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Tests\Unit\Elements\Text;

use AdamTheHutt\LeanForms\Elements\Text;
use AdamTheHutt\LeanForms\Tests\Concerns\ReliesOnViews;
use AdamTheHutt\LeanForms\Tests\TestForm;
use Orchestra\Testbench\TestCase;

/**
 * @covers \AdamTheHutt\LeanForms\Elements\BaseElement::data
 */
class DataTest extends TestCase
{
    use ReliesOnViews;

    /** @var TestForm */
    public $form;

    /** @var Text */
    public $subject;

    /** @test */
    public function it_sets_data_namespaced_property()
    {
        $this->form = new TestForm();
        $this->subject = new Text($this->form);

        $this->subject->data("toggle", "tooltip");
        $output = $this->subject->toHtml()->__toString();

        $this->assertStringContainsString('data-toggle="tooltip"', $output);
    }
}
