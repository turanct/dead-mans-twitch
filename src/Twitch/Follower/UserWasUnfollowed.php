<?php

namespace Twitch\Follower;

final class UserWasUnfollowed
{
    private $screenName;
    private $followerId;

    public function __construct(ScreenName $screenName, UserId $followerId)
    {
        $this->screenName = $screenName;
        $this->followerId = $followerId;
    }
}
