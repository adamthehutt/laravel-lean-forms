<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Tests;

use Illuminate\Support\HtmlString;
use Orchestra\Testbench\TestCase;

/** @covers \AdamTheHutt\LeanForms\AbstractForm::close */
class CloseTest extends TestCase
{
    /** @test */
    public function it_returns_an_html_string_object()
    {
        $subject = (new TestForm())->close();

        $this->assertInstanceOf(HtmlString::class, $subject);
    }

    /** @test */
    public function it_contains_a_closing_form_tag()
    {
        $subject = (new TestForm())->close();

        $this->assertEquals("</form>", $subject->toHtml());
    }
}
