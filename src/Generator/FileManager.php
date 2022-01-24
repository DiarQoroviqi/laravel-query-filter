<?php

namespace Deviar\LaravelQueryFilter\Generator;

use Illuminate\Support\Str;

trait FileManager
{
    private function getStub(string $type): string
    {
        return file_get_contents(__DIR__ . "/../Stubs/{$type}.stub");
    }
}
