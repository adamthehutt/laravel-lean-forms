<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Tests;

use AdamTheHutt\LeanForms\Elements\Text;

class TestCreate extends TestForm
{
    public function name()
    {
        return $this->element(Text::class)
            ->value("foo");
    }
}
