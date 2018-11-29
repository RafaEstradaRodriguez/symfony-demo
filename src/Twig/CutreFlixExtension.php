<?php

namespace App\Twig;

use App\Service\EmojiTranslator;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class CutreFlixExtension extends AbstractExtension
{
    /**
     * @var EmojiTranslator
     */
    private $emojiTranslator;

    public function __construct(EmojiTranslator $emojiTranslator)
    {
        $this->emojiTranslator = $emojiTranslator;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('emoji', [$this, 'emojiFilter'])
        ];
    }

    public function emojiFilter(string $texto)
    {
        return $this->emojiTranslator->fullTranslate($texto);
    }
}
