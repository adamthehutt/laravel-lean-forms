<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Console;

class FormGenerator
{
    /**
     * @param string $name
     * @return object
     */
    public function getClassInfo($name)
    {
        $explodedClassNamespace = explode('\\', $name);
        $className = array_pop($explodedClassNamespace);
        $fullNamespace = join('\\', $explodedClassNamespace);
        return (object)[
            'namespace' => $fullNamespace,
            'className' => $className
        ];
    }
}
