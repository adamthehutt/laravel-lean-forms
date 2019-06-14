<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Tests;

use Orchestra\Testbench\TestCase;

/**
 * @covers \AdamTheHutt\LeanForms\AbstractForm::route
 */
class RouteTest extends TestCase
{
    /** @test */
    public function it_guesses_store_from_naming_conventions()
    {
        app("router")->post('giraffe')->name("giraffe.store");

        $subject = new TestCreate(new Giraffe());

        $this->assertEquals('http://localhost/giraffe', $subject->route());
    }

    /** @test */
    public function it_guesses_update_from_naming_conventions()
    {
        app("router")->put('giraffe/{giraffe}')->name("giraffe.update");

        $model = new Giraffe();
        $model->id = rand(1, 100);
        $subject = new TestEdit($model);

        $expected = 'http://localhost/giraffe/'.$model->id;

        $this->assertEquals($expected, $subject->route());
    }

    /** @test */
    public function it_guesses_destroy_from_naming_conventions()
    {
        app("router")->delete('giraffe/{giraffe}')->name("giraffe.destroy");

        $model = new Giraffe();
        $model->id = rand(1, 100);
        $subject = new TestDestroy($model);

        $expected = 'http://localhost/giraffe/'.$model->id;

        $this->assertEquals($expected, $subject->route());
    }

    /** @test */
    public function it_prefers_a_class_property()
    {
        app("router")->delete('giraffe/{giraffe}')->name("giraffe.destroy");
        app("router")->get("abc123")->name("abc123");

        $subject = new TestDestroy(new Giraffe());

        $subject->setRoute("abc123");

        $this->assertEquals('http://localhost/abc123', $subject->route());
    }

    /**
     * @test
     */
    public function it_throws_a_runtime_exception_when_it_cant_figure_it_out()
    {
        $this->expectException(\RuntimeException::class);

        $subject = new TestForm();
        $subject->route();
    }
}
