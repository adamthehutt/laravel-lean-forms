<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Elements;

use Illuminate\Support\HtmlString;

class Month extends Select
{
    public function toHtml(): HtmlString
    {
        $this->options([
            '1' => 'January',
            '2' => 'February',
            '3' => 'March',
            '4' => 'April',
            '5' => 'May',
            '6' => 'June',
            '7' => 'July',
            '8' => 'August',
            '9' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December'
        ]);

        return parent::toHtml();
    }
}
