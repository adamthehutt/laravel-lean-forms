<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Tests\Fakes;

use AdamTheHutt\LeanForms\Elements\Text;

class FakeElement extends Text
{
    public function dotNotation(string $name)
    {
        return parent::dotNotation($name);
    }
}
