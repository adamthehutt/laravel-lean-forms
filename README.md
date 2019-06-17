## Laravel Lean Forms

#### Installation
```bash
php artisan composer require adamthehutt/laravel-lean-forms
```

If you would like to change the default skin or customize templates:
```bash
php artisan vendor:publish
```

#### Basic Usage
This package provides an expressive syntax for defining forms and fields, while 
allowing you to keep all domain logic outside of your Blade templates. 

For example:

```php
use AdamTheHutt\LeanForms\AbstractForm;
use AdamTheHutt\LeanForms\Elements\Select;
use AdamTheHutt\LeanForms\Elements\Text;
use AdamTheHutt\LeanForms\Elements\Textarea;

class AnimalCreate extends AbstractForm
{
    public $fields = [
        'name' => Text::class,
        'description' => Textarea:class
    ];

   /**
    * This field is a bit more complex so we'll define it explicitly rather
    * than simply in $this->fields.
    */
    public function preferredDiet()
    {
        return $this->element(Select::class)
                    ->multiple()
                    ->options(['Plants', 'Bugs', 'Humans']);
    }
}
```

And then in your template you only need to worry about client-side or 
display logic:
```blade
{{ $form->open() }}

{{ $form->name()
        ->attr("v-model", "animalName") }}

{{ $form->description()
        ->data("toggle", "tooltip")
        ->title("Description goes here, dummy") }}

{{ $form->preferredDiet()->class("foo-bar") }}
```

#### Form generator
The package includes an artisan command for generating new form classes:
```bash
php artisan make:lean-form "App\Http\Forms\Animal\Create"
```

Of course, you are free to namespace and store form classes wherever you like.

#### Form configuration
In general, this package tries to make some reasonable guesses based on 
naming conventions, but you always have the option of being explicit. Some
form class properties and methods you should know about:

__$method property__ &mdash; Can be set to any of the standard REST HTTP verbs. 
If it's not explicitly set then the package will try to guess based on the form 
class name. For example, if the class name is (or ends with) "Create", then POST
will be used; for "Edit", PUT; for "Destroy", DELETE.

__$route property or method__ &mdash; Property can be set to the string name of 
a defined route. More complicated routes can implement the route() method and
return, for example, route("animal.update", [$animal->id]). If neither the 
property nor the method is defined, then the package will try to guess based on
the form class name and model name. For example, if the form class basename is 
AnimalEdit and the associated model is Animal, then it would guess
route("animal.update", [$animal]).

__$files property__ &mdash; Set the $files property to true if you need the 
form to accept file uploads.

__Fields__ &mdash; Most of your form class logic will likely involve configuring 
fields. There are two ways you can do this. 
 1. Define the $fields property with a simple mapping of field name to the 
 desired Element class name, for example:
 $fields["foo" => Text::class]. This works in the most basic and routine 
 scenarios. In the example above, it would result in a text field with the id
 and name "foo", with all default logic applied.
 2. Define a method for specific form field. This allows for extensive 
 customization using a fluid interface. (Any of these can be used when 
 referencing the field in a Blade template as well.) Some of the options 
 available include:
     * name($value) &mdash; Set the form field's name (defaults to the snake_cased 
     name of the defining method)
     * id($value) &mdash; Set the id attribute (defaults to the name)
     * label($value) &mdash; Set the label text (defaults to a user-friendly version
     of the name)
     * class($value) &mdash; To override the template default for the element
     * labelClass() &mash; To override the template default for the label
     * options($map) &mdash; Key-value array or collection of options for select, 
     radio, etc.
     * value($value) &mdash; Set the value of the field (override the model property)
     * default($value) &mdash; Set the default value if otherwise empty
     * data($key, $value) &mdash; Set a data-xyz property on the element
     * attr($key, $value) &mdash; Set an arbitrary HTML attribute
     * readonly(), multiple(), placeholder($value), etc. &mdash; Set the 
     corresponding HTML attribute
     

#### Available field types
The following field types are currenly supported:
 * Button
 * Checkbox Boolean
 * Currency
 * Datepicker
 * Email
 * File
 * Hidden
 * Month
 * Radio
 * Select
 * Submit
 * Text
 * Textarea

#### Blade templates
Generating the form HTML in a Blade template is as simple as calling the 
associated methods. You can also use method chaining to attach display or client-side 
logic e.g.:
 * $form->open()
 * $form->name()->labelClass("sr-only")
 * $form->description()->attr("v-model", "animalDescription")
 * $form->submit("Save the Animal")
 * $form->close()

#### Form skinning
The package supports "skinning" forms according to different conventions or 
standards. The default (and only currently provided) skin is Bootstrap 3. (Pull
requests for templates supporting other skins are more than welcome!) You can
configure a default skin for your forms by setting the value in the 
lean-forms.php config file. You can also set it for an individual form by 
changing the $skin property.

#### Form field wrapping
The default skin automatically wraps each form field in a div.form-group 
element and generates a corresponding label element. You can turn off this
behavior by calling:
```php
{{ $form->open()->nowrap() }}
```
For more fine-grained control, you can also specify the $includeLabel and/or 
$includeFormGroup properties on an individual field.

#### Determining field values
When a form loads, the field values are generally determined based on the 
following (descending) order of priority:
 1. Submitted form input, i.e. ```old($name)```
 2. Explicitly assigned value, i.e. ```$form->animal()->value("giraffe")```
 3. Model property for field name, i.e. ```$form->model->animal``` 
 4. Explicitly assigned default, i.e. ```$form->animal()->default("giraffe")```
 
NB: There is additionally a special "__value" property that is used internally
but you don't need to worry about it unless you're extending a form element
class or modifying templates.
