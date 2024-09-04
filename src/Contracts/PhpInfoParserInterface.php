<?php

namespace Velibegov\PhpParser\Contracts;

interface PhpInfoParserInterface
{
    public static function parse(string $response): string;
}