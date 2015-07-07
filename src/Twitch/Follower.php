<?php

namespace Twitch;

final class Follower
{
    private $screenName;
    private $realName;

    public function __construct(ScreenName $screenName, RealName $realName)
    {
        $this->screenName = $screenName;
        $this->realName = $realName;
    }

    public function equals(Follower $other)
    {
        return $this->screenName->equals($other->screenName);
    }
}
