<?php

namespace Twitch\Follower;

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

    public function __toString()
    {
        return $this->id;
    }
}
