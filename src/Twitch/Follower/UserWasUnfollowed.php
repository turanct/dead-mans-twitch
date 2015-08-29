<?php

namespace Twitch\Follower;

use DateTime;

final class UserWasUnfollowed
{
    private $screenName;
    private $followerId;
    private $date;

    public function __construct(
        ScreenName $screenName,
        UserId $followerId,
        DateTime $date = null
    ) {
        $this->screenName = $screenName;
        $this->followerId = $followerId;

        if ($date === null) {
            $date = new DateTime('now');
        }
        $this->date = clone $date;
    }

    public function getScreenName()
    {
        return $this->screenName;
    }

    public function getFollowerId()
    {
        return $this->followerId;
    }

    public function getDate()
    {
        return clone $this->date;
    }
}
