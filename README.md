## Laravel Lean Forms
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

#### Installation


#### Form configuration


#### Blade templates


#### Form Skinning


#### Form Field Wrapping


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
