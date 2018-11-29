<?php

namespace App\Service;

/**
 * Podéis copiar y pegar emojis de https://www.emojicopy.com/
 */
class EmojiTranslator
{
    const EMOJIS = [
        'caca' => "💩",
        'avión' => "✈",
        'sol' => "☀"
    ];

    public function fullTranslate(string $texto)
    {
        return str_replace(array_keys(self::EMOJIS), array_values(self::EMOJIS), $texto);
    }
}
