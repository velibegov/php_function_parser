<?php

namespace Velibegov\PhpParser\Services;

use DOMDocument;
use DOMXPath;
use Velibegov\PhpParser\Contracts\PhpInfoParserInterface;

class PhpInfoParser implements PhpInfoParserInterface
{

    public static function parse(string $response): string
    {
        $dom = new DOMDocument;

        libxml_use_internal_errors(true);
        $dom->loadHTML(self::clean($response));
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);

        $elements = $xpath->query('//*[@class="refsect1 description"]');

        $result = '';
        foreach ($elements as $element) {
            $result .= $dom->saveHTML($element);
        }
        return $result;
    }

    private static function clean(string $text): string
    {
        return preg_replace('/<a[^>]*>(.*?)<\/a>/', '$1', $text);
    }
}