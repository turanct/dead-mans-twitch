<?php

namespace Twitch;

use InvalidArgumentException;

final class UserId
{
    private $id;

    public function __construct($id)
    {
        $this->id = (string) $id;
    }

    public function equals(UserId $otherId)
    {
        return $this->id === $otherId->id;
    }
}

