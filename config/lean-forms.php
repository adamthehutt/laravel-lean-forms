<?php
declare(strict_types=1);

return [
    "skin" => env("LEAN_FORMS_SKIN", "bootstrap3"),

    /**
     * Define an array of paths to search for form classes when resolving
     * from the LeanFormsManager.
     */
    "namespaces" => [
        "App\\Http\\Forms\\",
        // second choice,
        // third choice,
        // etc.
    ]
];
