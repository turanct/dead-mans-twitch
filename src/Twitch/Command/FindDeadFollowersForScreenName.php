<?php

namespace Twitch\Command;

use Twitch\Follower\ScreenName;

final class FindDeadFollowersForScreenName
{
    private $screenName;

    public function __construct(ScreenName $screenName)
    {
        $this->screenName = $screenName;
    }

    public function getScreenName()
    {
        return $this->screenName;
    }
}
