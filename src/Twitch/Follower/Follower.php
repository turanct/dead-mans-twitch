<?php

namespace Twitch\Follower;

final class Follower
{
    private $id;
    private $screenName;
    private $realName;

    public function __construct(UserId $id, ScreenName $screenName, RealName $realName)
    {
        $this->id = $id;
        $this->screenName = $screenName;
        $this->realName = $realName;
    }

    public function equals(Follower $other)
    {
        return $this->id->equals($other->id);
    }
}
