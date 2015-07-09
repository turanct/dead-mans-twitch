<?php

namespace Twitch;

use Twitch\Follower\UserId;
use Twitch\Follower\ScreenName;

interface Twitter
{
    /**
     * Get a list of follower ids of a certain profile
     *
     * @param ScreenName $screenName The name of the profile
     *
     * @return UserId[]
     */
    public function getFollowersOf(ScreenName $screenName);

    /**
     * Get a Follower's profile by id
     *
     * @param UserId $id The id of the follower
     *
     * @return Follower
     */
    public function getFollowerById(UserId $id);
}
