<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Tests\Unit\AbstractForm;

use AdamTheHutt\LeanForms\Tests\Giraffe;
use AdamTheHutt\LeanForms\Tests\TestCreate;
use Orchestra\Testbench\TestCase;

class GetTest extends TestCase
{
    /** @test */
    public function it_gets_the_value_of_a_defined_field()
    {
        $form = new TestCreate();

        $this->assertEquals("foo", $form->name);
    }

    /** @test */
    public function it_falls_back_to_old_input()
    {
        $this->setOldInput(['address' => "bar"]);

        $form = new TestCreate();
        $this->assertEquals("bar", $form->address);
    }

    /** @test */
    public function it_falls_back_to_old_input_snake_cased()
    {
        $this->setOldInput(['postal_code' => "bar"]);

        $form = new TestCreate();
        $this->assertEquals("bar", $form->postalCode);
    }

    /** @test */
    public function it_falls_back_to_model_attribute()
    {
        $model = new Giraffe();
        $model->setAttribute("city", "baz");

        $form = new TestCreate($model);
        $this->assertEquals("baz", $form->city);
    }

    /** @test */
    public function it_falls_back_to_snake_cased_model_attribute()
    {
        $model = new Giraffe();
        $model->setAttribute("postal_code", "quux");

        $form = new TestCreate($model);
        $this->assertEquals("quux", $form->postalCode);
    }

    /** @test */
    public function it_favors_old_input_over_model_attribute()
    {
        $this->setOldInput(['address' => "foo"]);

        $model = new Giraffe();
        $model->setAttribute("address", "bar");

        $form = new TestCreate($model);
        $this->assertEquals("foo", $form->address);
    }

    /** @test */
    public function it_gets_multiple_as_json()
    {
        $this->setOldInput([
            'name' => 'foo',
            'address' => 'bar'
        ]);

        $model = new Giraffe();
        $model->setAttribute("city", "baz");
        $model->setAttribute("postal_code", "quux");

        $form = new TestCreate($model);
        $expected = json_encode([
            "name" => "foo",
            "address" => "bar",
            "city" => "baz",
            "postalCode" => "quux"
        ]);

        $this->assertEquals($expected, $form->json(["name", "address", "city", "postalCode"]));
    }

    private function setOldInput(array $oldInput)
    {
        $this->app['router']->get('hello', ['middleware' => 'web', 'uses' => function () use ($oldInput) {
            $request = request()->merge($oldInput);
            $request->flash();

            return 'hello world';
        }]);
        $this->call('GET', 'hello');
    }
}
