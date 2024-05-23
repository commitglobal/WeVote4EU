<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public static function languages(): array
    {
        return [
            'bulgarian' => ['bg'],
            'croatian' => ['hr'],
            'czech' => ['cs'],
            'danish' => ['da'],
            'dutch' => ['nl'],
            'english' => ['en'],
            'estonian' => ['et'],
            'finnish' => ['fi'],
            'french' => ['fr'],
            'german' => ['de'],
            'greek' => ['el'],
            'hungarian' => ['hu'],
            'irish' => ['ga'],
            'italian' => ['it'],
            'luxembourgish' => ['lb'],
            'latvian' => ['lv'],
            'lithuanian' => ['lt'],
            'maltese' => ['mt'],
            'polish' => ['pl'],
            'portuguese' => ['pt'],
            'romanian' => ['ro'],
            'slovak' => ['sk'],
            'slovene' => ['sl'],
            'spanish' => ['es'],
            'swedish' => ['sv'],
        ];
    }
}
