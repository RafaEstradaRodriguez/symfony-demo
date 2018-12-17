<?php

namespace App\Service;

use Symfony\Component\Security\Core\Security;

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

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function fullTranslate(string $texto)
    {
        return str_replace(array_keys(self::EMOJIS), array_values(self::EMOJIS), $texto);
    }
}
