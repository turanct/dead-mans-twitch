<?php

namespace Twitch;

final class RealName
{
    private $name;

    public function __construct($name)
    {
        $this->name = (string) $name;
    }
}
