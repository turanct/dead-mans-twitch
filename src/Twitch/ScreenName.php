<?php

namespace Twitch;

use InvalidArgumentException;

final class ScreenName
{
    private $name;

    public function __construct($name)
    {
        $this->assertBeginsWithAtSign($name);

        $this->name = (string) $name;
    }

    private function assertBeginsWithAtSign($name)
    {
        if (strpos($name, '@') !== 0) {
            throw new InvalidArgumentException('Screennames should begin with @');
        }
    }

    public function equals(ScreenName $otherName)
    {
        return mb_strtolower($this->name) == mb_strtolower($otherName->name);
    }
}
