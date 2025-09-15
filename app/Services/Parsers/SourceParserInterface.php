<?php

namespace App\Services\Parsers;

interface SourceParserInterface
{
    /**
     * Verilen raw payload'ı parse ederek normalize edilmiş içerik döndürür.
     * Dönen array, insert/update için hazır olmalı.
     *
     * @param string $payload
     * @return array<int, array<string, mixed>>
     */
    public function parse(string $payload): array;
}
